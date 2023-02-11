<?php
namespace Tsel\Blog\controllers;

use Tsel\Blog\core\Controller;
use Tsel\Blog\core\View;
use Tsel\Blog\models\ProfileModel;
use Tsel\Blog\services\Profile;

class ProfileController extends Controller
{
    public function __construct()
    {
        $model = ProfileModel::class;
        $this->model = new $model;
        $this->view = new View();
    }

    public function introduce()
    {
        $form = $this->model->getForm();
        echo $this->view->render('form', $form);
    }

    public function read()
    {
        $profile = Profile::Specified->choose($this->model);
        echo $this->view->render('profile', $profile);
    }

    public function update()
    {
        Profile::Modified->choose($this->model);
        echo $this->view->render('admin', []);
    }

    public function administer() {
        echo $this->view->render('admin', []);
    }
}