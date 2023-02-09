<?php
namespace Tsel\Blog\models;


use Tsel\Blog\core\Model;

class NewsModel extends Model
{
    const SQL_GET_NEWS = "SELECT * FROM news";
    public function getData()
    {
        $news = parent::$dataBase->getBasePrepare(self::SQL_GET_NEWS, []);
        $total = parent::$dataBase->rowCount(self::SQL_GET_NEWS, []);
        return array('news' => $news, 'total' => $total);
    }
}