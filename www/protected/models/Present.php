<?php
class Present
{
    public static function getPresentList()
    {
        $presentList = Yii::app()->db->createCommand("
            select
              p.image, up.date, up.message, up.id,
              u.username, u.name, coalesce((
                    select
                        image_50
                    from
                        {{photos}} ii, {{photos_folder}} ff
                    where
                        ff.title=:thumb_title and
                        ii.folder_id=ff.id and
                        ff.user_id=u.id
                    order by ii.id desc
                    limit 1
                ),u.image_50)
                image_50
            from
              {{present}} p, {{present_user}} up, {{user}} u
            where
              up.user_to_id=:user_id and
              up.present_id=p.id and
              u.id=up.user_from_id
            order by
              up.id desc
        ");
        $presentList->bindParam(":user_id",$_SESSION['MEMBERS']['ID'],PDO::PARAM_INT);
        $presentList->bindParam(":thumb_title",$t = Photo::PHOTO_THUMB_FOLDER_TITLE,PDO::PARAM_STR);

        return $presentList->queryAll();
    }
}