<?php
namespace Tsel\Blog\core;

class Model
{
    public function getData()
    {
        return json_decode(file_get_contents("php://input"), true);
    }
}