<?php
class Photo
{
    const PHOTO_AVATAR = 1;
    const PHOTO_THUMB_FOLDER_TITLE = 'profile_photo';

    public static function saveImage($image,$folder_type = null,$size = null, $folder_id = null)
    {
        $new_file_name = 'big_'.md5(time()).'.'.strtolower(end(explode('.',$image)));

        list($width,$height) = getimagesize($image);
        $max_size = max($width,$height);
        /**
         * определяем максимальную пропорцию
         */
        $k = $max_size/534;
        $w = ceil($width/$k);
        $h = ceil($height/$k);
        $size1 = min($w,$h)-100;


        foreach($size as &$value)
        {
            $value = $value * $k;
        }
        unset($value);



        Yii::import("ext.EPhpThumb.EPhpThumb");

        $thumb=new EPhpThumb();
        $thumb->init();

        $thumb->create($image)
            ->crop(intval($size['x1']),intval($size['y1']),intval($size['x2']-$size['x1']),intval($size['y2']-$size['y1']))
            ->adaptiveResize(200,200)
            ->save('./photos/'.$new_file_name);

        $new_file_name_thumb = 'thumb_'.md5(time()).'.'.strtolower(end(explode('.',$image)));
        $thumb=new EPhpThumb();
        $thumb->init();
        $thumb->create($image)
            ->crop(intval($size['x1']),intval($size['y1']),intval($size['x2']-$size['x1']),intval($size['y2']-$size['y1']))
            ->adaptiveResize(70,70)
            ->save('./photos/'.$new_file_name_thumb);

        $new_file_name_50 = '50_'.md5(time()).'.'.strtolower(end(explode('.',$image)));
        $thumb=new EPhpThumb();
        $thumb->init();
        $thumb->create($image)
            ->crop(intval($size['x1']),intval($size['y1']),intval($size['x2']-$size['x1']),intval($size['y2']-$size['y1']))
            ->adaptiveResize(50,50)
            ->save('./photos/'.$new_file_name_50);

        $new_file_name_31 = '31_'.md5(time()).'.'.strtolower(end(explode('.',$image)));
        $thumb=new EPhpThumb();
        $thumb->init();
        $thumb->create($image)
            ->crop(intval($size['x1']),intval($size['y1']),intval($size['x2']-$size['x1']),intval($size['y2']-$size['y1']))
            ->adaptiveResize(31,31)
            ->save('./photos/'.$new_file_name_31);

        $new_file_name_1024 = str_replace('./photos/','',$image);


        if(empty($folder_id))
        {
            /**
             * проверяем наличие альбома
             */
            switch($folder_type) {
                case self::PHOTO_AVATAR:

                    /**
                     * проверяем наличие альбома для аватарок
                     */
                    $list = Yii::app()->db->createCommand("
                        select id from tbl_photos_folder where user_id=:user_id and title=:title
                    ");
                    $title = self::PHOTO_THUMB_FOLDER_TITLE;
                    $list->bindParam(":user_id",$_SESSION['MEMBERS']['ID'],     PDO::PARAM_INT);
                    $list->bindParam(":title", $title , PDO::PARAM_STR);
                    $list =  $list->queryAll();

                    if(empty($list[0]['id']))
                    {
                        $folder_id = self::addFolder(self::PHOTO_THUMB_FOLDER_TITLE);
                    }
                    else
                    {
                        $folder_id = $list[0]['id'];
                    }

                    break;
            }
        }

        /**
         * вставка самой фтографии
         */
        $new_photo = Yii::app()->db->createCommand("
            insert into {{photos}} (folder_id,image,image_thumb,image_50,image_31,image_1024,user_id)
            values (:folder_id,:image,:image_thumb,:image_50,:image_31,:image_1024,:user_id)
            returning id
        ");
        $new_photo->bindParam(":user_id",     $_SESSION['MEMBERS']['ID'],PDO::PARAM_INT);
        $new_photo->bindParam(":folder_id",   $folder_id,PDO::PARAM_INT);
        $new_photo->bindParam(":image",       $new_file_name,PDO::PARAM_STR);
        $new_photo->bindParam(":image_thumb", $new_file_name_thumb,PDO::PARAM_STR);
        $new_photo->bindParam(":image_50",    $new_file_name_50,PDO::PARAM_STR);
        $new_photo->bindParam(":image_31",    $new_file_name_31,PDO::PARAM_STR);
        $new_photo->bindParam(":image_1024",  $new_file_name_1024,PDO::PARAM_STR);
        $photo_id = $new_photo->queryAll();
        $photo_id = $photo_id[0]['id'];

        /**
         * вставляем новостное сообщение
         */
        Post::savePost('','',$photo_id);

        /**
         * если заявлена на обновление аватарки
         */
        if($folder_type==self::PHOTO_AVATAR)
        {
            $_SESSION['MEMBERS']['image'] = $new_file_name;
            $_SESSION['MEMBERS']['image_thumb'] = $new_file_name_thumb;
            $_SESSION['MEMBERS']['image_50'] = $new_file_name_50;
            $_SESSION['MEMBERS']['image_31'] = $new_file_name_31;
            $_SESSION['MEMBERS']['image_1024'] = $new_file_name_1024;
        }
    }

    public static function addFolder($title)
    {
        $new_folder = Yii::app()->db->createCommand("
            insert into {{photos_folder}} (user_id,title,date,visible)
            values (:user_id,:title,NOW(),1)
            returning id
        ");
        $new_folder->bindParam(":user_id",$_SESSION['MEMBERS']['ID'],PDO::PARAM_INT);
        $new_folder->bindParam(":title",  $title,PDO::PARAM_STR);
        $new_folder =  $new_folder->queryAll();

        return $new_folder[0]['id'];
    }

    /**
     * получение контента для подробной информации о изображении
     */
    public static function getImageContent($post_id)
    {
        /**
         * получаем id и имя пользователя
         */
        $new_folder = Yii::app()->db->createCommand("
            select

                (select count(0) from {{like}} where user_id=:user_id and post_id=:post_id) like_active,
                (select count(0) from {{like}} where post_id=:post_id) like_count,
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
                    limit 5),'//') like_images,

                p.date,
                u.name,
                u.username,
                ff.id folder_id
            from
                {{post}} p, {{user}} u, {{photos}} f, {{photos_folder}} ff
            where
                p.id=:post_id and
                u.id=p.user_id and
                f.folder_id=ff.id and
                p.image=f.id
        ");
        $new_folder->bindParam(":post_id",intval($post_id),PDO::PARAM_INT);
        $new_folder->bindParam(":user_id",$_SESSION['MEMBERS']['ID'],PDO::PARAM_INT);
        $new_folder->bindParam(":thumb_title",$t = Photo::PHOTO_THUMB_FOLDER_TITLE,PDO::PARAM_STR);
        $member =  $new_folder->queryAll();

        $return['post_id'] = intval($post_id);
        $return['like_active'] = $member[0]['like_active'];
        $return['like_count'] = $member[0]['like_count'];
        $return['like_images'] = $member[0]['like_images'];

        $return['time'] = Post::timeFormat(strtotime($member[0]['date']));
        $return['name'] = $member[0]['name'];
        $return['username'] = $member[0]['username'];
        $return['folder_id'] = $member[0]['folder_id'];

        $return['post_list'] = array_pop(Post::getTimeLineList(intval($post_id)));
        $return['post_list'] = $return['post_list']['comment'];
        return $return;
    }
}