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
	 * регистрация пользователя
	 */
	public function actionSignup()
	{
        $error = array();
        if(!empty($_POST['insert_flag']) && empty($_SESSION['SIGNUP_STEP']))
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
            if(trim($_POST['password'])=='')
                $error[] = 'Password<br />Please enter a valid password.';

            /**
            * проверяем чтобы пароли совпали
            */
            if($_POST['password']!=$_POST['passconf'])
                $error[] = 'Password Again<br />Please make sure the "password" and "password again" fields match.';

            /**
            * проверяем url
            */
            if(empty($_POST['username']))
                $error[] = 'Profile Address<br />Please enter a valid profile address.';
            else
            {
                /**
                 * проверяем уникальность введённого url
                 */
                /**
                 * проверяем уникальность мыла
                 */
                $testEmail = Yii::app()->db->createCommand("select count(0) c from {{user}} where username=:username");
                $testEmail->bindParam(":username",$_POST['username'],PDO::PARAM_STR);
                $r = $testEmail->queryAll();

                if($r[0]['c']>0)
                    $error[] = 'Profile Address<br />Someone has already picked this profile address, please use another one.';
            }

            /**
            * подтверждение согласия с правилами сервиса
            */
            if(empty($_POST['terms']))
                $error[] = 'Terms of Service<br />Please complete this field - it is required.<br />You must agree to the terms of service to continue.';

            if(count($error)==0)
            {
                $_SESSION['SIGNUP_STEP'] = 1;
                $_POST['insert_flag'] = 0;

                User::registrate(array(
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'username' => $_POST['username'],
                    'timezone' => $_POST['timezone'],
                ));
            }
        }

        if(!empty($_POST['insert_flag']) && $_SESSION['SIGNUP_STEP']==1)
        {
            /**
             * проверяем что ввёдено имя
             */
            if(trim($_POST['name'])=='')
                $error[] = 'Animal nickname<br />Please complete this field - it is required.';

            if(count($error)==0)
            {
                $_SESSION['SIGNUP_STEP'] = 2;
                $_POST['insert_flag'] = 0;

                User::updateProfiler(array(
                    'name' => $_POST['name'],
                    'sex' => $_POST['sex'],
                    'birthday' => strtotime($_POST['day'].'.'.$_POST['month'].'.'.$_POST['year']),
                    'site' => $_POST['site'],
                    'twitter' => $_POST['twitter'],
                    'facebook' => $_POST['facebook'],
                    'aim' => $_POST['aim'],
                    'about' => $_POST['about'],
                ));
            }
        }

        /**
         * сохранение аватарки пользователя
         */
        if(!empty($_POST['image']))
        {
            User::updatePhoto(array(
                'image' => $_POST['image'],
                'image_thumb' => $_POST['image_thumb'],
                'image_31' => $_POST['image_31'],
                'image_50' => $_POST['image_50']
            ));

            session_write_close();
            header('location:/');
            exit();
        }

        /**
         * загрузка непосредственно изобрадения
         */
        if(!empty($_POST['upload_photo']))
        {
            $new_file_name = 'big_'.md5(time()).'.'.strtolower(end(explode('.',$_FILES['photo']['name'])));

            Yii::import("ext.EPhpThumb.EPhpThumb");

            $thumb=new EPhpThumb();
            $thumb->init();

            $thumb->create($_FILES['photo']['tmp_name'])
                  ->adaptiveResize(200,200)
                  ->save('./photos/'.$new_file_name);

            $new_file_name_thumb = 'thumb_'.md5(time()).'.'.strtolower(end(explode('.',$_FILES['photo']['name'])));
            $thumb=new EPhpThumb();
            $thumb->init();
            $thumb->create($_FILES['photo']['tmp_name'])
                  ->adaptiveResize(70,70)
                  ->save('./photos/'.$new_file_name_thumb);

            $new_file_name_50 = '50_'.md5(time()).'.'.strtolower(end(explode('.',$_FILES['photo']['name'])));
            $thumb=new EPhpThumb();
            $thumb->init();
            $thumb->create($_FILES['photo']['tmp_name'])
                  ->adaptiveResize(50,50)
                  ->save('./photos/'.$new_file_name_50);

            $new_file_name_31 = '31_'.md5(time()).'.'.strtolower(end(explode('.',$_FILES['photo']['name'])));
            $thumb=new EPhpThumb();
            $thumb->init();
            $thumb->create($_FILES['photo']['tmp_name'])
                  ->adaptiveResize(31,31)
                  ->save('./photos/'.$new_file_name_31);

            print '<div id="new_photo"><img width="200" height="200" src="/photos/'.$new_file_name.'" /><br /><br />';
            print '<img class="thumb" width="70" height="70" src="/photos/'.$new_file_name_thumb.'" />
                   <input type="hidden" name="image" value="'.$new_file_name.'" />
                   <input type="hidden" name="image_thumb" value="'.$new_file_name_thumb.'" />
                   <input type="hidden" name="image_50" value="'.$new_file_name_50.'" />
                   <input type="hidden" name="image_31" value="'.$new_file_name_31.'" />
                   </div>';

            print '<script>
                window.parent.$("#current-photo").height( window.parent.$("#current-photo").height() + \'px\' );
                window.parent.$("#current-photo").html( document.getElementById(\'new_photo\').innerHTML );
                window.parent.$("#current-photo").height(\'auto\');
            </script>';
            exit();
        }

        if(empty($_SESSION['SIGNUP_STEP']))
		    $this->render('signup',array('error' => $error));
        elseif($_SESSION['SIGNUP_STEP']==1)
            $this->render('signup_step2',array('error' => $error));
        elseif($_SESSION['SIGNUP_STEP']==2)
            $this->render('signup_step3',array('error' => $error));
	}

    /**
     * авторизация
     */
    public function actionSignin()
    {
        $error = array();

        /**
         * авторизация пользователя
         */
        if(!empty($_POST['insert_flag']))
        {
            /**
             * проверяем валидность почты
             */
            $validator = new CEmailValidator;

            $_POST['email'] = trim($_POST['email']);
            if(!$validator->validateValue($_POST['email']))
                $error[] = 'Email Address<br />Please enter a valid email address.';

            if(trim($_POST['password'])=='')
                $error[] = 'Password<br />Please complete this field - it is required.';

            if(count($error)==0)
            {
                /**
                 * проверяем на существование пользователя
                 */
                $testEmail = Yii::app()->db->createCommand("select count(0) c from {{user}} where email=:email");
                $testEmail->bindParam(":email",trim($_POST['email']),PDO::PARAM_STR);
                $r = $testEmail->queryAll();
                if($r[0]['c']==0)
                    $error[] = 'No record of a member with that email was found.';

            }

            /**
             * проверяем пароль
             */
            if(count($error)==0)
            {
                /**
                 * проверяем на существование пользователя
                 */
                $testEmail = Yii::app()->db->createCommand("select password from {{user}} where email=:email");
                $testEmail->bindParam(":email",trim($_POST['email']),PDO::PARAM_STR);
                $r = $testEmail->queryAll();
                if(trim($r[0]['password'])!=trim($_POST['password']))
                    $error[] = 'The credentials you have supplied are invalid. Please check your email and password, and try again.';

            }

            if(count($error)==0)
            {
                User::authorization($_POST['email'],$_POST['password']);
                session_write_close();
                header('location:/');
                exit();
            }

        }


        $this->render('signin',array('error' => $error));
    }

    /**
     * выход
     */
    public function actionLogout()
    {
        unset($_SESSION['MEMBERS']);

        session_write_close();
        header('location:/');
        exit();
    }

 }