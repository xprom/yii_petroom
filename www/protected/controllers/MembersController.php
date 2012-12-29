<?php

class MembersController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return;
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionSignup()
	{
        $error = array();
        if(!empty($_POST['insert_flag']))
        {
            $validator = new CEmailValidator;

            $_POST['email'] = trim($_POST['email']);

            if(!$validator->validateValue($_POST['email']))
                $error[] = 'Email Address<br />Please enter a valid email address.';
            else
            {
                /**
                * проверяем уникальность мыла
                */
                $testEmail = Yii::app()->db->createCommand("select count(0) c from {{user}} where email=:email");
                $testEmail->bindParam(":email",$_POST['email'],PDO::PARAM_STR);
                $r = $testEmail->queryAll();

                if($r[0]['c']>0)
                    $error[] = 'Email Address<br />Someone has already registered this email address, please use another one.';
            }

            /**
            * проверяем что ввёдён нпароль
            */
            if(trim($_POST['password']))
                $error[] = 'Password<br />Please enter a valid password.';

            /**
            * проверяем чтобы пароли совпали
            */
            if($_POST['password']!=$_POST['passconf'])
                $error[] = 'Password Again<br />Please make sure the "password" and "password again" fields match.';

            /**
            * проверяем чтобы пароли совпали
            */
            if(empty($_POST['username']))
                $error[] = 'Profile Address<br />Please enter a valid profile address.';

            /**
            * проверяем чтобы пароли совпали
            */
            if(empty($_POST['terms']))
                $error[] = 'Terms of Service<br />Please complete this field - it is required.<br />You must agree to the terms of service to continue.';

        }

		$this->render('signup',array('error' => $error));
	}
}