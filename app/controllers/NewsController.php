<?php

namespace Tsel\Blog\controllers;

use Tsel\Blog\core\Controller;
use Tsel\Blog\core\View;
use Tsel\Blog\models\NewsModel;
use Tsel\Blog\services\News;

class NewsController extends Controller
{
    public function __construct()
    {
        $model = NewsModel::class;
        $this->model = new $model;
        $this->view = new View();
    }

    public function make() {
        echo $this->view->render('blank', []);
    }

    public function create() {
        News::Writing->choose($this->model);
        echo $this->view->render('admin', []);
    }

    public function read($href) {
        $data = News::Reading->choose($this->model, $href);
        echo $this->view->render('news', $data);
    }

    public function search()
    {
        $data = News::Searching->choose($this->model);
        echo $this->view->render('admin', $data);
    }

    public function list()
    {
        $data = News::Listing->choose($this->model);
        echo $this->view->render('admin', $data);
    }

    public function mark($href)
    {
        $data = News::Marking->choose($this->model, $href);
        echo $this->view->render('news', $data);
    }
}