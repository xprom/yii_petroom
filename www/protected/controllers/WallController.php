<?php

class WallController extends Controller
{
	/**
     * Declares class-based actions.
     */
    public function actionIndex()
    {
        $data = User::getHomeData($_SESSION['MEMBERS']['username']);
        $this->myFriend = $data['myFriend'];
        $this->newFriend = $data['newFriend'];
        $this->member   = $data['member'];
        $this->render('//site/members/home',$data);
    }

}