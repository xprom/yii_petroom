<?php

class PresentsController extends Controller
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
    public function actionIndex()
    {
        $content = array();
        $content['presentList'] = Present::getPresentList();

        $this->render('index',$content);
    }

}