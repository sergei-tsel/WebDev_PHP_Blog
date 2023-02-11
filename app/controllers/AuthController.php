<?php
namespace Tsel\Blog\controllers;

use Tsel\Blog\core\Controller;
use Tsel\Blog\core\View;
use Tsel\Blog\models\AccountModel;
use Tsel\Blog\services\Account;


class AuthController extends Controller
{
    public function __construct()
    {
        $model = AccountModel::class;
        $this->model = new $model;
        $this->view = new View();
    }

    public function form()
    {
        $new = $this->model->getAcceptForm();
        echo $this->view->render('auth', $new);
    }

    public function login()
    {
        Account::Auth->choose($this->model);
        echo $this->view->render('admin', []);
    }

    public function accept()
    {
        $data = Account::New->choose($this->model);
        echo $this->view->render('form', $data);
    }
}