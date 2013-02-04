<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 */
class Post
{
    public static function getTimeLineList($post_id = null)
    {
        $list = Yii::app()->db->createCommand("
        with recursive  postList  (
            lvl, id, date, text,parent_id, link, image, user_id, map_x, map_y, zoom
        ) as (
            select * from (
                select
                    1 lvl, id, date_part('epoch', date) date, text,parent_id, link, image, user_id, map_x, map_y, zoom
                from
                    {{post}}
                where
                    parent_id is null and deleted=0
                    ".((!empty($post_id))?'and id=:post_id':'')."
             ) t

            union all

            select * from (
                select
                    2 lvl,
                    tn.id,
                    date_part('epoch', tn.date) date,
                    tn.text,
                    tn.parent_id,
                    tn.link,
                    tn.image,
                    tn.user_id,
                    tn.map_x,
                    tn.map_y,
                    tn.zoom
                from
                    postList tp, {{post}} tn
                where
                    tp.id = tn.parent_id and tn.deleted=0
             ) t2
        )

            select
                t.*,
                l.link,
                l.title,
                l.description,
                l.image,
                i.image as image_news,
                i.image_1024 as image_1024_news,
                f.title as photo_folder_title
            from
            (
            select
                p.*,


                coalesce((
                    select
                        image_50
                    from
                        {{photos}} ii, {{photos_folder}} ff
                    where
                        ff.title=:thumb_title and
                        ii.folder_id=ff.id and
                        ff.user_id=:user_id
                    order by ii.id desc
                    limit 1
                ),u.image_50)
                image_50,



                u.name,
                u.username,
                (select count(0) from {{like}} where user_id=:user_id and post_id=p.id) like_active,
                (select count(0) from {{like}} where post_id=p.id) like_count,

                array_to_string(ARRAY(
                    select
                        lu.username||'||'||coalesce((
                                                        select
                                                            image_31
                                                        from
                                                            {{photos}} ii, {{photos_folder}} ff
                                                        where
                                                            ff.title=:thumb_title and
                                                            ii.folder_id=ff.id and
                                                            ff.user_id=li.user_id
                                                        order by ii.id desc
                                                        limit 1
                                                    ),lu.image_31)
                    from
                        {{user}} lu, {{like}} li
                    where
                        li.user_id=lu.id and
                        li.post_id=p.id
                    order by
                        case when user_id=:user_id then 1 else 0 end desc
                    limit 5),'//') like_images
            from
                postList p,
                {{user}} u
            where
                p.user_id=:user_id and
                p.user_id=u.id
            group by
                p.map_x,
                p.map_y,
                p.zoom,
                p.lvl,
                p.id,
                p.date,
                p.text,
                p.parent_id,
                p.link,
                p.image,
                p.user_id,
                u.image_50,
                u.name,
                u.username
            order by
                case when p.lvl=1 then p.id else -1*p.id end desc
            ) t
            left join {{post_link}} l on t.id=l.id_post
            left join {{photos}} i    on i.id=t.image
            left join {{photos_folder}} f    on f.id=i.folder_id

        ");
        $list->bindParam(":user_id",$_SESSION['MEMBERS']['ID'],PDO::PARAM_INT);
        $list->bindParam(":thumb_title",$title = Photo::PHOTO_THUMB_FOLDER_TITLE,PDO::PARAM_STR);
        if(!empty($post_id))
            $list->bindParam(":post_id",$post_id,PDO::PARAM_INT);

        $list =  $list->queryAll();
        $return = array();

        /**
         * группируем комментарии
         */
        foreach($list as $value)
        {
            if(empty($value['parent_id']))
            {
                if(isset($return[$value['id']]))
                    $return[$value['id']] = $value + $return[$value['id']];
                else
                    $return[$value['id']] = $value;
            }
            else
            {
                $return[$value['parent_id']]['comment'][] = $value;
            }
        }

        return $return;
    }

    public static function savePost($text,$parent_id,$image_id = null)
    {
        if(trim($text)==''
            && !(!empty($_GET['map_zoom']) && !empty($_GET['map_x']) && !empty($_GET['map_y']))
            && !(!empty($_GET['url']) && isset($_GET['show_image']) && isset($_GET['image']) && isset($_GET['title']) && isset($_GET['desc']))
            && empty($image_id)
        )
            return false;



        if(!empty($parent_id))
        {
            $insertPost = Yii::app()->db->createCommand("
                insert into {{post}} (
                  user_id,
                  date,
                  text,
                  parent_id
                  ".($image_id?',image':'')."
                ) values (
                    :user_id,
                    now(),
                    :text,
                    :parent_id
                    ".($image_id?',:image':'')."
                ) returning id
            ");
            $insertPost->bindParam(":parent_id",   $parent_id,PDO::PARAM_INT);
        }
        else
        {
            $insertPost = Yii::app()->db->createCommand("
                insert into {{post}} (
                  user_id,
                  date,
                  text
                  ".($image_id?',image':'')."
                ) values (
                  :user_id,
                  now(),
                  :text
                  ".($image_id?',:image':'')."
                ) returning id
            ");
        }

        if(!empty($_GET['map_zoom']) && !empty($_GET['map_x']) && !empty($_GET['map_y']))
        {
            $insertPost = Yii::app()->db->createCommand("
                insert into {{post}} (user_id,date,text,parent_id,map_x,map_y,zoom) values (:user_id,now(),:text,:parent_id,:map_x,:map_y,:zoom)
            ");
            $insertPost->bindParam(":parent_id",   $parent_id,PDO::PARAM_INT);
        }

        $insertPost->bindParam(":text",   $text,PDO::PARAM_STR);
        $insertPost->bindParam(":user_id",$_SESSION['MEMBERS']['ID'],PDO::PARAM_INT);

        if(!empty($image_id))
            $insertPost->bindParam(":image",  $image_id,PDO::PARAM_INT);

        if(!empty($_GET['map_zoom']) && !empty($_GET['map_x']) && !empty($_GET['map_y']))
        {
            $insertPost->bindParam(":zoom", intval($_GET['map_zoom']),PDO::PARAM_INT);
            $insertPost->bindParam(":map_x",floatval($_GET['map_x']),PDO::PARAM_INT);
            $insertPost->bindParam(":map_y",floatval($_GET['map_y']),PDO::PARAM_INT);
        }


        $res = $insertPost->queryAll();

        /**
         * вставляем ссылку на ресурс
         */
        if(!empty($_GET['url']) && isset($_GET['show_image']) && isset($_GET['image']) && isset($_GET['title']) && isset($_GET['desc']))
        {
            $insetLink = Yii::app()->db->createCommand("
                insert into {{post_link}} (id_post,link,title,description,image)
                values (:id_post,:link,:title,:description,:image)
            ");
            $insetLink->bindParam(":id_post",$res[0]['id'],PDO::PARAM_INT);
            $insetLink->bindParam(":link",$_GET['url'],PDO::PARAM_STR);
            $insetLink->bindParam(":title",$_GET['title'],PDO::PARAM_STR);
            $insetLink->bindParam(":description",$_GET['desc'],PDO::PARAM_STR);
            if(empty($_GET['show_image']))
                $_GET['image'] = '';

            $insetLink->bindParam(":image",$_GET['image'],PDO::PARAM_STR);
            $insetLink->queryAll();
        }

        return $res[0]['id'];
    }

    public static function like($postId)
    {
        if(empty($_SESSION['MEMBERS']['ID']))
            return false;

        $insertLike = Yii::app()->db->createCommand("
            insert into {{like}} (post_id,user_id) values (:post_id,:user_id)
        ");
        $insertLike->bindParam(":post_id",intval($postId),PDO::PARAM_INT);
        $insertLike->bindParam(":user_id",$_SESSION['MEMBERS']['ID'],PDO::PARAM_INT);
        $insertLike->queryAll();

        return true;
    }

    public static function unlike($postId)
    {
        if(empty($_SESSION['MEMBERS']['ID']))
            return false;

        $insertLike = Yii::app()->db->createCommand("
            delete from {{like}} where post_id=:post_id and user_id=:user_id
        ");
        $insertLike->bindParam(":post_id",intval($postId),PDO::PARAM_INT);
        $insertLike->bindParam(":user_id",$_SESSION['MEMBERS']['ID'],PDO::PARAM_INT);
        $insertLike->queryAll();

        return true;
    }

    /**
     * форматирует время в независимый формат от момента генерации его
     * @param $timestamp
     * @return string
     */
    public static function timeFormat($timestamp)
    {
        return date('l ',intval($timestamp)).'at '.date('h:i a',intval($timestamp));
    }

    /**
     * форматирует время в зависимости от времени когда оно произошло
     * @param $timestamp
     * @return string
     */
    public static function timeFormatFeed($timestamp)
    {
        $wall_X_seconds_ago = array("%s second ago","%s seconds ago");
        $wall_X_minutes_ago = array("%s minute ago","%s minutes ago");
        $wall_X_hours_ago = array("%s hour ago","%s hours ago");
        $wall_X_seconds_ago_words = array("one second ago","two seconds ago","three seconds ago","four seconds ago","five seconds ago");
        $wall_X_minutes_ago_words = array("one minute ago","two minutes ago","three minutes ago","4 minutes ago","5 minutes ago");
        $wall_X_hours_ago_words = array("one hour ago","two hours ago","3 hours ago","4 hours ago","5 hours ago");

        if(!function_exists('langWordNumeric'))
        {
            function langWordNumeric($num,$words,$arr)
            {
                if(is_array($words) && $num<=count($words))
                    return $words[$num-1];

                return str_replace('%s',$num,$arr[1]);
            }
        }

        $diff = time() - intval($timestamp);
        if($diff<5)
            return 'A few seconds ago';
        if($diff<60)
            return langWordNumeric($diff,$wall_X_seconds_ago_words,$wall_X_seconds_ago);
        if($diff<3600)
            return langWordNumeric(intval($diff/60),$wall_X_minutes_ago_words,$wall_X_minutes_ago);
        if($diff<4*3600)
            return langWordNumeric(intval($diff/3600),$wall_X_hours_ago_words,$wall_X_hours_ago);
        if(date('d.m.Y')==date('d.m.Y',$timestamp))
            return 'Today at '.date('h:i a',intval($timestamp));
        if(date('d.m.Y',strtotime('-1 day'))==date('d.m.Y',$timestamp))
            return 'Yesterday at '.date('h:i a',intval($timestamp));

        return date('l ',intval($timestamp)).'at '.date('h:i a',intval($timestamp));
    }

    /**
     * удаление поста автором
     * @param $postId
     * @return bool
     */
    public static function delete($postId)
    {
        if(empty($_SESSION['MEMBERS']['ID']))
            return false;

        $deletePost = Yii::app()->db->createCommand("
            update {{post}} set deleted=1 where id=:post_id and user_id=:user_id
        ");
        $deletePost->bindParam(":post_id",intval($postId),PDO::PARAM_INT);
        $deletePost->bindParam(":user_id",$_SESSION['MEMBERS']['ID'],PDO::PARAM_INT);
        $deletePost->queryAll();

        return true;
    }

    /**
     * отена удаления , тоесть восстановление поста
     * @param $postId
     * @return bool
     */
    public static function undelete($postId)
    {
        if(empty($_SESSION['MEMBERS']['ID']))
            return false;

        $unDeletePost = Yii::app()->db->createCommand("
            update {{post}} set deleted=0 where id=:post_id and user_id=:user_id
        ");
        $unDeletePost->bindParam(":post_id",intval($postId),PDO::PARAM_INT);
        $unDeletePost->bindParam(":user_id",$_SESSION['MEMBERS']['ID'],PDO::PARAM_INT);
        $unDeletePost->queryAll();

        return true;
    }
}