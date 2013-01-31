<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

    public function init()
    {
        if(isset($_POST['x1']) && isset($_POST['x2']) && isset($_POST['y1']) && isset($_POST['y2']))
        {
            Photo::saveImage(
                './photos/'.$_POST['image_1024'],
                Photo::PHOTO_AVATAR,
                array(
                    'x1'=>$_POST['x1'],
                    'x2'=>$_POST['x2'],
                    'y1'=>$_POST['y1'],
                    'y2'=>$_POST['y2'],
                )
            );
        }

        try
        {
            /**
             * фактическое сохранение аватарки
             * и обновляем текущую аватарку пользователя
             */


            /**
             * update main photo
             */
            if(!empty($_GET['mainPhoto']))
            {
                if(is_file($_FILES['photo']['tmp_name']))
                {
                    $new_file_name = 'big_'.md5(time()).'.'.strtolower(end(explode('.',$_FILES['photo']['name'])));
                    Yii::import("ext.EPhpThumb.EPhpThumb");

                    $thumb=new EPhpThumb();
                    $thumb->init();

                    $new_file_name_1024 = '1024_'.md5(time()).'.'.strtolower(end(explode('.',$_FILES['photo']['name'])));
                    $thumb=new EPhpThumb();
                    $thumb->init();
                    $thumb->create($_FILES['photo']['tmp_name'])
                        ->adaptiveResize(1024,768)
                        ->save('./photos/'.$new_file_name_1024);


                    $this->renderPartial('ajax/update_photo',array(
                        'new_file_name_1024'  => $new_file_name_1024,
                    ));
                    exit();
                }
            }

            /**
             * добавлние поста
             */
            if(isset($_GET['savePost']))
            {
                Post::savePost($_GET['text'],$_GET['parent_id']);
                exit();
            }


            if(!empty($_GET['save_status']))
            {
                User::saveStatus($_GET['text']);
                exit();
            }

            /**
             * установка лайка
             */
            if(isset($_GET['makeLike']))
            {
                Post::like($_GET['postId']);
                exit();
            }
            /**
             * установка лайка
             */
            if(isset($_GET['unLike']))
            {
                Post::unlike($_GET['postId']);
                exit();
            }

            /**
             * подтрверждение статуса друга
             */
            if(isset($_GET['confirmFriend']))
            {
                User::updateFriendStatus(intval($_GET['friendId']),User::FRIEND_STATUS_CONFIRM);
                exit();
            }

            /**
             * оставить друга в подписчиках
             */
            if(isset($_GET['deleteFriend']))
            {
                User::updateFriendStatus(intval($_GET['friendId']),User::FRIEND_STATUS_FOLGEN);
                exit();
            }

            /**
             * удалить заявку в друзья
             */
            if(isset($_GET['removeFriend']))
            {
                User::updateFriendStatus(intval($_GET['friendId']),User::FRIEND_STATUS_UN_CONFIRM);
                exit();
            }

            /**
             * удаление поста
             */
            if(isset($_GET['deletePost']))
            {
                Post::delete($_GET['postId']);
                exit();
            }

            /**
             * восстановление поста
             */
            if(isset($_GET['unDeletePost']))
            {
                Post::undelete($_GET['postId']);
                exit();
            }

            /**
             * подгрузка url сайта
             */
            if(!empty($_GET['getLinkContent']))
            {
                $resurl = Link::getLinkContent($_GET['link']);

                print json_encode($resurl);
                exit();
            }

        }
        catch(Exception $e)
        {

        }
    }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        $data = array();

        /**
         * есчли человек авторизован
         * то выводим всю информацию для его стены
         */
        if(!empty($_SESSION['MEMBERS']['ID']))
        {
            $data['wall'] = Post::getTimeLineList();

            /**
             * новые заявки в друзья
             */
            $data['newFriend'] = User::getFriendList(6,false,User::FRIEND_STATUS_NEW);

            /**
             * мои взаимные друзья
             */
            $data['myFriend'] = User::getFriendList(10,false,User::FRIEND_STATUS_CONFIRM);
        }


        // renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
        if(!empty($_SESSION['MEMBERS']['ID']))
            $this->render('members/home',$data);
        else
		    $this->render('index',$data);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}