<?php
namespace Tsel\Blog\models;

use Tsel\Blog\core\Model;

class AccountModel extends Model
{
    const SQL_SET_ACCOUNT = "INSERT INTO account (login, password, dt_create, is_active) VALUES (:login, :password, now(), true) returning id";
    const SQL_GET_ACCOUNT = "SELECT * FROM account WHERE login = :login AND password = :password";

    const SQL_DELETE_ACCOUNT = "DELETE FROM account WHERE id = :id";

    public function getAcceptForm()
    {
        return ['action' => 'accept', 'type' => 'text', 'button' => 'Отправить' ];
    }

    public function getCheckForm()
    {
        return ['action' => 'login', 'type' => 'password', 'button' => 'Войти'];
    }

    public function create()
    {
        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';
        if($login !== '' && $password !== '') {
            parent::$dataBase->setBasePrepare(self::SQL_SET_ACCOUNT, ['login' => $login, 'password' => $password]);
            return parent::$dataBase->lastInsertId();
        }
    }

    function checkAuth()
    {
        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';
        $user = parent::$dataBase->getBasePrepare(self::SQL_GET_ACCOUNT, ['login' => $login, 'password' => $password]);
        return $user['id'];
    }

    public function delete($id) {
        parent::$dataBase->setBasePrepare(self::SQL_DELETE_ACCOUNT, ['id' => $id]);
    }
}