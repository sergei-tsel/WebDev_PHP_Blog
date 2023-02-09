<?php
namespace Tsel\Blog\core;

use DataBase;

class Model
{
    public static DataBase $dataBase;

    public function getData()
    {
        return json_decode(file_get_contents("php://input"), true);
    }
}