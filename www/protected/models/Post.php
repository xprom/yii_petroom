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
            select * from {{post}} where user_id=:user_id
        ");
        $list->bindParam(":user_id",$_SESSION['MEMBERS']['ID'],PDO::PARAM_INT);
        return $list->queryAll();
    }

    public static function savePost($text)
    {
        $insertMember = Yii::app()->db->createCommand("
            insert into {{status}} (user_id,date,text) values (:user_id,now(),:text)
        ");
        $insertMember->bindParam(":text",   $text,PDO::PARAM_STR);
        $insertMember->bindParam(":user_id",$_SESSION['MEMBERS']['ID'],PDO::PARAM_INT);
        $insertMember->queryAll();

        $_SESSION['MEMBERS']['status'] = $text;

        self::updateSessionData();

    }
}