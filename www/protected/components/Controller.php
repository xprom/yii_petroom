<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    /**
     * список моих друзей
     * @var array
     */
    public $myFriend = array();

    /**
     * список новых друзей
     * @var array
     */
    public $newFriend = array();

    /**
     * инфорация о пользователе, на чьей странице мы сейчас находимся
     * @var array
     */
    public $member = array();


    public function init()
    {
        $data = User::getHomeData($_SESSION['MEMBERS']['username']);
        $this->myFriend = $data['myFriend'];
        $this->newFriend = $data['newFriend'];
        $this->member   = $data['member'];

        try
        {
            /**
             * добавлние поста
             */
            if(isset($_GET['savePost']))
            {
                $post_id = Post::savePost($_GET['text'],$_GET['parent_id']);
                print json_encode(array(
                    'class'=>'post-'.$post_id,
                    'id'=> $post_id,
                ));
                exit();
            }

            /**
             * получение подробноей информации о фотографии
             */
            if(isset($_GET['getImageContent']))
            {
                $photoContent = Photo::getImageContent(intval($_GET['postId']));
                $this->renderPartial('ajax/photo_info',$photoContent);
                exit();
            }


            /**
             * фактическое сохранение аватарки
             * и обновляем текущую аватарку пользователя
             */
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
}