<?php
namespace Tsel\Blog\services;

use Tsel\Blog\models\AccountModel;

enum User
{
    case Reader;
    case Origin;

    public function choose($id = null, $model = null)
    {
        return match($this) {
            User::Reader => $this->callNews($id, $model),
            User::Origin => $this->checkGuest()
        };
    }

    private function callNews($id, $model)
    {
        return $model->getById($id);
    }

    private function checkGuest()
    {
        $accountModel = new AccountModel();
        return $accountModel->getCheckForm();
    }
}
