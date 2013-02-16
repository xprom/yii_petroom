<?php

class PhotosController extends Controller
{


    public function actionIndex()
    {
        $data['folder'] = Photo::getFolderList($_SESSION['MEMBERS']['ID']);
        $this->render('index',$data);
    }

    /**
     * показываем содержимое альбома
     */
    public function actionFolder()
    {
        $id = intval($_GET['id']);

        $data['photos'] = Photo::getPhotoList($id);
        $this->render('folder',$data);
    }
}