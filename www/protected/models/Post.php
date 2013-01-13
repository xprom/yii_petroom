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
            id, date, text,parent_id, link, image
        ) as (
            select * from (
                select
                    id, date, text,parent_id, link, image
                from
                    {{post}}
                where
                    parent_id is null
                order by
                    id desc
                limit
                    2
            ) t

            union all

            select
                tn.id, tn.date, tn.text,tn.parent_id, tn.link, tn.image
            from
                postList tp, {{post}} tn
            where
                tp.id = tn.parent_id
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
                limit 5),'//') like_images
            from
                postList p,
                {{user}} u
            where
                p.user_id=:user_id and
                p.user_id=u.id and
        ");
        $list->bindParam(":user_id",$_SESSION['MEMBERS']['ID'],PDO::PARAM_INT);
        return $list->queryAll();
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
}