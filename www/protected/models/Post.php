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
    public static function getTimeLineList()
    {
        $list = Yii::app()->db->createCommand("
        with recursive  postList  (
            lvl, id, date, text,parent_id, link, image, user_id
        ) as (
            select * from (
                select
                    1 lvl, id, date_part('epoch', date) date, text,parent_id, link, image, user_id
                from
                    {{post}}
                where
                    parent_id is null
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
                    tn.user_id
                from
                    postList tp, {{post}} tn
                where
                    tp.id = tn.parent_id
             ) t2
        )

            select
                p.*,
                u.image_50,
                u.name,
                u.username,
                (select count(0) from {{like}} where user_id=:user_id and post_id=p.id) like_active,
                (select count(0) from {{like}} where post_id=p.id) like_count,
                array_to_string(ARRAY(select lu.username||'||'||lu.image_31
                from {{user}} lu, {{like}} li
                where li.user_id=lu.id and li.post_id=p.id
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

        ");
        $list->bindParam(":user_id",$_SESSION['MEMBERS']['ID'],PDO::PARAM_INT);
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

    public static function savePost($text,$parent_id)
    {
        if(trim($text)=='')
            return false;

        if(!empty($parent_id))
        {
            $insertMember = Yii::app()->db->createCommand("
                insert into {{post}} (user_id,date,text,parent_id) values (:user_id,now(),:text,:parent_id)
            ");
            $insertMember->bindParam(":parent_id",   $parent_id,PDO::PARAM_INT);
        }
        else
        {
            $insertMember = Yii::app()->db->createCommand("
                insert into {{post}} (user_id,date,text) values (:user_id,now(),:text)
            ");
        }

        $insertMember->bindParam(":text",   $text,PDO::PARAM_STR);
        $insertMember->bindParam(":user_id",$_SESSION['MEMBERS']['ID'],PDO::PARAM_INT);
        $insertMember->queryAll();
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
        return date('l ',intval($timestamp)).'at '.date('H:i:s',intval($timestamp));
    }

    /**
     * форматирует время в зависимости от времени когда оно произошло
     * @param $timestamp
     * @return string
     */
    public static function timeFormatFeed($timestamp)
    {
        return date('l ',intval($timestamp)).'at '.date('H:i:s',intval($timestamp));
    }

}