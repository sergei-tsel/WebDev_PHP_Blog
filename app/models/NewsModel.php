<?php
namespace Tsel\Blog\models;


use Tsel\Blog\core\Model;

class NewsModel extends Model
{
    const SQL_SET_NEWS = "INSERT INTO news (id_profile, title, dt_publish, prev_desc, full_desc, href_news, tag, amount_like, amount_view) VALUES (:profile, :title, now(), :prev, :full, :href, :tag, 0, 0)";
    const SQL_GET_NEWS = "SELECT * FROM news";
    const SQL_GET_ONE_NEWS_BY_HREF = "SELECT * FROM news WHERE href_news = :href";
    const SQL_GET_NEWS_AS_SEARCH_RESULT = "SELECT news.title, news.prev_desc, news.href_news, news.tag, profile.id, profile.name, profile.surname, profile.href_avatar FROM news JOIN profile ON news.id_profile = profile.id WHERE news.title ~* :title OR news.tag ~* :tag OR profile.name ~* :firstname OR profile.surname ~* :surname";
    const SQL_GET_LATEST_NEWS_LIST = "SELECT news.title, news.prev_desc, news.href_news, news.tag, profile.id, profile.name, profile.surname, profile.href_avatar FROM news JOIN profile ON news.id_profile = profile.id WHERE news.dt_publish > (now() - interval '1 day') ORDER BY news.amount_like, news.amount_view DESC";
    const SQL_GET_NEWS_AUTHOR = "SELECT name, surname FROM profile where id = :id";
    const  SQL_SET_NEWS_VIEW = "UPDATE news SET amount_view = amount_view + 1 WHERE href_news = :href";
    const SQL_SET_NEWS_LIKE = "UPDATE news SET amount_like = amount_like + 1 WHERE href_news = :href";
    const SQL_SET_LIKE = "INSERT INTO like (id_news, id_profile) VALUES (:news, :profile)";
    const SQL_GET_LIKE = "SELECT * FROM like where id_news = :news AND id_profile = :profile";

    public function setNews($author)
    {
        $title = $_POST['title'] ?? '';
        $prevDesc = $_POST['prev'] ?? '';
        $fullDesc = $_POST['full'] ?? '';
        $href = $_POST['href'] ?? '';
        $tag = $_POST['tag'] ?? '';
        parent::$dataBase->setBasePrepare(self::SQL_SET_NEWS, ['profile' => $author, 'title' => $title, 'prev' => $prevDesc, 'full' => $fullDesc, 'href' => $href, 'tag' => $tag]);
    }

    public function setLike($href, $profileId)
    {
        $news = parent::$dataBase->getBasePrepare(self::SQL_GET_ONE_NEWS_BY_HREF, ['href_news' => $href]);
        parent::$dataBase->setBasePrepare(self::SQL_SET_NEWS_LIKE, [$href]);
        parent::$dataBase->setBasePrepare(self::SQL_SET_LIKE, ['news' => $news[0]['id'], 'profile' => $profileId]);
    }

    public function getData()
    {
        $news = parent::$dataBase->getBasePrepare(self::SQL_GET_NEWS, []);
        for($i = 0; $i < count($news); $i++ ) {
            $news[$i]['tag'] = explode(';', $news[0]['tag']);
        }
        $total = parent::$dataBase->rowCount(self::SQL_GET_NEWS, []);
        return array('news' => $news, 'total' => $total);
    }

    public function getNewsByHref($href, $profileId = null)
    {
        parent::$dataBase->setBasePrepare(self::SQL_SET_NEWS_VIEW, ['href' => $href]);
        $news = parent::$dataBase->getBasePrepare(self::SQL_GET_ONE_NEWS_BY_HREF, ['href' => $href]);
        $author = parent::$dataBase->getBasePrepare(self::SQL_GET_NEWS_AUTHOR, ['id' => $news[0]['id_profile']]);
        $news[0]['tag'] = explode(';', $news[0]['tag']);
        if ($profileId !== null) {
            $like = parent::$dataBase->getBasePrepare(self::SQL_GET_LIKE, ['news' => $news[0]['id'], 'profile' => $profileId]);
            if (!empty($like['news_id'])) {
                return array('news' => $news[0], 'author' => $author[0], 'like' => 'like');
            }
        }
        return array('news' => $news[0], 'author' => $author[0]);
    }

    public function searchNewsAndAuthors()
    {
        $search = $_POST['search'] ?? '';
        $search = $search;
        $news = parent::$dataBase->getBasePrepare(self::SQL_GET_NEWS_AS_SEARCH_RESULT, ['title' => $search, 'tag' => $search, 'firstname' => $search, 'surname' => $search]);
        for($i = 0; $i < count($news); $i++ ) {
            $news[$i]['tag'] = explode(';', $news[0]['tag']);
        }
        $total = parent::$dataBase->rowCount(self::SQL_GET_NEWS_AS_SEARCH_RESULT, ['title' => $search, 'tag' => $search, 'firstname' => $search, 'surname' => $search]);
        return array('news' => $news, 'total' => $total);
    }

    public function getLatestNewsList()
    {
        $news = parent::$dataBase->getBasePrepare(self::SQL_GET_LATEST_NEWS_LIST, []);
        $total = parent::$dataBase->rowCount(self::SQL_GET_LATEST_NEWS_LIST, []);
        return array('news' => $news, 'total' => $total);
    }
}