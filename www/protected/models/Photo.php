<?php
class Photo
{
    const PHOTO_AVATAR = 1;
    const PHOTO_THUMB_FOLDER_TITLE = 'profile_photo';

    public static function saveImage($image,$folder_type = null,$size = null, $folder_id = null)
    {
        $new_file_name = 'big_'.md5(time()).'.'.strtolower(end(explode('.',$image)));
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

        $new_file_name_1024 = '1024_'.md5(time()).'.'.strtolower(end(explode('.',$image)));
        $thumb=new EPhpThumb();
        $thumb->init();
        $thumb->create($image)
            ->crop(intval($size['x1']),intval($size['y1']),intval($size['x2']-$size['x1']),intval($size['y2']-$size['y1']))
            ->adaptiveResize(1024,768)
            ->save('./photos/'.$new_file_name_1024);


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

}