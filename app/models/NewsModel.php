<?php
namespace Tsel\Blog\models;


use Tsel\Blog\core\Model;

class NewsModel extends Model
{
    const SQL_SET_NEWS = "INSERT INTO news (id_profile, title, dt_publish, prev_desc, full_desc, href_news, tag, amount_like, amount_view) VALUES (:profile, :title, now(), :prev, :full, :href, :tag, 0, 0)";
    const SQL_GET_NEWS = "SELECT * FROM news";
    const SQL_GET_ONE_NEWS_BY_HREF = "SELECT * FROM news WHERE href_news = :href";
    const SQL_GET_NEWS_AS_SEARCH_RESULT = "SELECT news.title, news.prev_desc, news.href_news, news.tag, profile.id, profile.name, profile.surname, profile.href_avatar FROM news JOIN profile ON news.id_profile = profile.id WHERE to_tsvector('english', news.title) @@ to_tsquery('english', :entitle) OR to_tsvector('russian', news.title) @@ to_tsquery('russian', :rutitle) OR to_tsvector('english', news.tag) @@ to_tsquery('english', :entag) OR to_tsvector('russian', news.tag) @@ to_tsquery('russian', :rutag) OR to_tsvector('english', profile.name) @@ to_tsquery('english', :enname) OR to_tsvector('russian', profile.name) @@ to_tsquery('russian', :runame) OR to_tsvector('english', profile.surname) @@ to_tsquery('english', :ensurname OR to_tsvector('russian', profile.surname) @@ to_tsquery('russian', :rusurname)";
    const SQL_GET_LATEST_NEWS_LIST = "SELECT news.title, news.prev_desc, news.href_news, news.tag, profile.id, profile.name, profile.surname, profile.href_avatar FROM news JOIN profile ON news.id_profile = profile.id WHERE news.dt_publish > (now() - DAY) () ORDER BY news.amount_like, news.amount_view DESC";
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
        $news[0]['tag'] = explode(';', $news[0]['tag']);
        return array('news' => $news[0], 'author' => $author[0]);
    }

    public function searchNewsAndAuthors()
    {
        $search = $_POST['search'];
        $news = parent::$dataBase->getBasePrepare(self::SQL_GET_NEWS_AS_SEARCH_RESULT, ['entitle' => $search, 'rutitle' => $search, 'entag' => $search, 'rutag' => $search, 'enname' => $search, 'runame' => $search, 'ensurname' => $search, 'rusurname' => $search]);
        $total = parent::$dataBase->rowCount(self::SQL_GET_NEWS_AS_SEARCH_RESULT, []);
        return array('news' => $news, 'total' => $total);
    }

    public function getLatestNewsList()
    {
        $news = parent::$dataBase->getBasePrepare(self::SQL_GET_LATEST_NEWS_LIST, []);
        $total = parent::$dataBase->rowCount(self::SQL_GET_LATEST_NEWS_LIST, []);
        return array('news' => $news, 'total' => $total);
    }
}