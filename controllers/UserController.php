<?php
namespace controllers;
use core\Controller;
use core\Model;
use core\Session;
use core\Url;
use models\User;

class UserController extends Controller
{
    public function actionLogin()
    {
        if(Session::get('loggedIn'))
            $this->redirect(Url::to('site/index'));

        $username = $this->request->post('username');

        if($this->request->isPost()) {
            $user = Model::find(User::class, ['where' => [
                'username' => $username,
                'password' => md5($this->request->post('password')),
            ]]);

            if(!empty($user)) {
                Session::set('loggedIn', true);
                $this->redirect(Url::to('site/index'));
            }
        }

        $this->render('login', ['username' => $username]);
    }

    public function actionLogout()
    {
        Session::destroy();
        $this->redirect(Url::to('site/index'));
    }
}