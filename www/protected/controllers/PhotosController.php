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
        $this->render('index');
    }
}