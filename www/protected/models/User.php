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
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user';
	}

    /**
     * добавление нового пользователя
     * @param array $data
     */
    public static function registrate($data = array())
    {
        $insertMember = Yii::app()->db->createCommand("insert into {{user}} (email,password,username,timezone) values (:email,:password,:username,:timezone) returning id");
        $insertMember->bindParam(":email",$data['email'],PDO::PARAM_STR);
        $insertMember->bindParam(":password",$data['password'],PDO::PARAM_STR);
        $insertMember->bindParam(":username",$data['username'],PDO::PARAM_STR);
        $insertMember->bindParam(":timezone",$data['timezone'],PDO::PARAM_STR);
        $r = $insertMember->queryAll();
        $_SESSION['MEMBERS']['ID'] = $r[0]['id'];

        self::updateSessionData();
    }

    /**
     * обновляем контактную информацию о пользователе
     * @param array $data
     */
    public static function updateProfiler($data = array())
    {
        $insertMember = Yii::app()->db->createCommand("
          update {{user}} set
              name=:name,
              sex=:sex,
              birthday=:birthday,
              site=:site,
              twitter=:twitter,
              facebook=:facebook,
              aim=:aim,
              about=:about
          where id=:id
        ");
        $insertMember->bindParam(":name",$data['name'],PDO::PARAM_STR);
        $insertMember->bindParam(":sex",intval($data['sex']),PDO::PARAM_INT);
        $insertMember->bindParam(":birthday",date('d.m.Y',$data['birthday']),PDO::PARAM_STR);
        $insertMember->bindParam(":site",$data['site'],PDO::PARAM_STR);
        $insertMember->bindParam(":twitter",$data['twitter'],PDO::PARAM_STR);
        $insertMember->bindParam(":facebook",$data['facebook'],PDO::PARAM_STR);
        $insertMember->bindParam(":aim",$data['aim'],PDO::PARAM_STR);
        $insertMember->bindParam(":about",$data['about'],PDO::PARAM_STR);
        $insertMember->bindParam(":id",$_SESSION['MEMBERS']['ID'],PDO::PARAM_INT);
        $r = $insertMember->queryAll();

        self::updateSessionData();
    }
    /**
     * обновляем фотографию пользователя
     * @param array $data
     */
    public static function updatePhoto($data = array())
    {
        $insertMember = Yii::app()->db->createCommand("
          update {{user}} set
              image_thumb=:image_thumb,
              image_50=:image_50,
              image=:image
          where id=:id
        ");
        $insertMember->bindParam(":image",$data['image'],PDO::PARAM_STR);
        $insertMember->bindParam(":image_thumb",$data['image_thumb'],PDO::PARAM_STR);
        $insertMember->bindParam(":image_50",$data['image_50'],PDO::PARAM_STR);
        $insertMember->bindParam(":id",$_SESSION['MEMBERS']['ID'],PDO::PARAM_INT);
        $r = $insertMember->queryAll();

        self::updateSessionData();
    }

    /**
     * обновляем данные сессии
     */
    public static function updateSessionData()
    {
        $data = Yii::app()->db->createCommand("select * from {{user}} where id=:id");
        $data->bindParam(":id",$_SESSION['MEMBERS']['ID'],PDO::PARAM_INT);
        $r = $data->queryAll();

        $_SESSION['MEMBERS']['image'] = $r[0]['image'];
        $_SESSION['MEMBERS']['image_thumb'] = $r[0]['image_thumb'];
        $_SESSION['MEMBERS']['image_50'] = $r[0]['image_50'];

        $_SESSION['MEMBERS']['name'] = $r[0]['name'];
        $_SESSION['MEMBERS']['sex'] = $r[0]['sex'];
        $_SESSION['MEMBERS']['birthday'] = $r[0]['birthday'];
        $_SESSION['MEMBERS']['site'] = $r[0]['site'];
        $_SESSION['MEMBERS']['twitter'] = $r[0]['twitter'];
        $_SESSION['MEMBERS']['facebook'] = $r[0]['facebook'];
        $_SESSION['MEMBERS']['aim'] = $r[0]['aim'];
        $_SESSION['MEMBERS']['about'] = $r[0]['about'];
        $_SESSION['MEMBERS']['username'] = $r[0]['username'];
        $_SESSION['MEMBERS']['timezone'] = $r[0]['timezone'];
        $_SESSION['MEMBERS']['email'] = $r[0]['email'];
    }

    public static function saveStatus($text)
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

    public static function authorization($login,$password)
    {
        $testEmail = Yii::app()->db->createCommand("select id from {{user}} where email=:email");
        $testEmail->bindParam(":email",trim($login),PDO::PARAM_STR);
        $r = $testEmail->queryAll();

        $_SESSION['MEMBERS']['ID'] = $r[0]['id'];
        self::updateSessionData();
    }

}