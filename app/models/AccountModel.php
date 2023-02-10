<?php
namespace Tsel\Blog\models;

use Tsel\Blog\core\Model;
class AccountModel extends Model
{
    public function getCheckForm()
    {
        return ['action' => 'login', 'type' => 'password', 'value' => '', 'button' => 'Войти'];
    }
}