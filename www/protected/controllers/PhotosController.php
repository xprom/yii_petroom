<?php

class PhotosController extends Controller
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return;
    }

    public function actionIndex()
    {
        $content['folder'] = Photo::getFolderList($_SESSION['MEMBERS']['ID']);

        $this->render('index',$content);
    }
}