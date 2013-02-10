<?php

class ProfileController extends Controller
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return;
    }

    public function __call($name, $arguments)
    {
        print $name;
        exit();
    }

    public function actionIndex()
    {
        $data = User::getHomeData($_GET['member']);
        $this->myFriend = $data['myFriend'];

        $this->render('//site/members/home',$data);
    }
}