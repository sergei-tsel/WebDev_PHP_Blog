<?php
namespace Tsel\Blog;

use DataBase;
use Tsel\Blog\core\Model;
use Tsel\Blog\core\Route;


require_once "lib/DataBase.php";

$dataBase = new DataBase();
Model::$dataBase = $dataBase;
Route::start();