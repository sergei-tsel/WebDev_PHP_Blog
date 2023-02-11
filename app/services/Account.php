<?php

namespace Tsel\Blog\services;

use Tsel\Blog\models\ProfileModel;

enum Account
{
    case Auth;
    case New;

    public function choose($model)
    {
        $accountId = match($this) {
            Account::Auth => $model->checkAuth(),
            Account::New => $model->create()
        };

        if(!empty($accountId)) {
            setcookie('login', $_POST['login'], 0, '/');
            setcookie('password', $_POST['password'], 0, '/');
            header('Location: /index.php');
            session_start();

            if ($this === Account::New) {
                $profileModel = new ProfileModel();
                $profileModel->setProfile($accountId);
                return $profileModel->getForm();
            }
        }
    }
}
