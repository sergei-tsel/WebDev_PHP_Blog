<?php
namespace Tsel\Blog\models;


use Tsel\Blog\core\Model;

class NewsModel extends Model
{
    const SQL_SET_NEWS = "INSERT INTO news (id_profile, title, dt_publish, prev_desc, full_desc, href_news, tag, amount_like, amount_view) VALUES (:profile, :title, now(), :prev, :full, :href, :tag, 0, 0)";
    const SQL_GET_NEWS = "SELECT * FROM news";
    const SQL_GET_ONE_NEWS_BY_HREF = "SELECT * FROM news WHERE href_news = :href";

    const SQL_GET_NEWS_AUTHOR = "SELECT name, surname FROM profile where id = :id";

    const  SQL_SET_NEWS_VIEW = "UPDATE news SET amount_view = amount_view + 1 WHERE href_news = :href";

    public function setNews($author)
    {
        $title = $_POST['title'] ?? '';
        $prevDesc = $_POST['prev'] ?? '';
        $fullDesc = $_POST['full'] ?? '';
        $href = $_POST['href'] ?? '';
        $tag = $_POST['tag'] ?? '';
        parent::$dataBase->setBasePrepare(self::SQL_SET_NEWS, [$author, $title, $prevDesc, $fullDesc, $href, $tag]);
    }
    public function getData()
    {
        $news = parent::$dataBase->getBasePrepare(self::SQL_GET_NEWS, []);
        $total = parent::$dataBase->rowCount(self::SQL_GET_NEWS, []);
        return array('news' => $news, 'total' => $total);
    }

    public function getNewsByHref($href)
    {
        parent::$dataBase->setBasePrepare(self::SQL_SET_NEWS_VIEW, [$href]);
        $news = parent::$dataBase->getBasePrepare(self::SQL_GET_ONE_NEWS_BY_HREF, ['href_news' => $href]);
        $author = parent::$dataBase->getBasePrepare(self::SQL_GET_NEWS_AUTHOR, ['id' => $news[0]['id_profile']]);
        return array('news' => $news[0], 'author' => $author[0]);
    }
}