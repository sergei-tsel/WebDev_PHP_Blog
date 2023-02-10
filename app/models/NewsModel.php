<?php
namespace Tsel\Blog\models;


use Tsel\Blog\core\Model;

class NewsModel extends Model
{
    const SQL_GET_NEWS = "SELECT * FROM news";
    const SQL_GET_ONE_NEWS = "SELECT * FROM news WHERE id = :id";

    const SQL_GET_NEWS_AUTHOR = "SELECT name, surname FROM profile where id = :id";

    public function getData()
    {
        $news = parent::$dataBase->getBasePrepare(self::SQL_GET_NEWS, []);
        $total = parent::$dataBase->rowCount(self::SQL_GET_NEWS, []);
        return array('news' => $news, 'total' => $total);
    }

    public function getById($id)
    {
        $news = parent::$dataBase->getBasePrepare(self::SQL_GET_ONE_NEWS, ['id' => $id]);
        $author = parent::$dataBase->getBasePrepare(self::SQL_GET_NEWS_AUTHOR, ['id' => $news[0]['id_profile']]);
        return array('news' => $news[0], 'author' => $author[0]);
    }
}