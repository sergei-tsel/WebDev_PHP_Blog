<?php
namespace Tsel\Blog\controllers;

use Tsel\Blog\core\Controller;
use Tsel\Blog\core\View;
use Tsel\Blog\models\NewsModel;
use Tsel\Blog\services\User;

class MainController extends Controller
{
    public function __construct()
    {
        $model = NewsModel::class;
        $this->model = new $model;
        $this->view = new View();
    }

    public function index()
    {
        $data = $this->model->getData();
        echo $this->view->render('main', $data);
    }

    public function read($id)
    {
        $data = User::Reader->choose($id, $this->model);
        echo $this->view->render('news', $data);
    }
}