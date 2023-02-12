<?php
namespace Tsel\Blog\services;

use Tsel\Blog\models\AccountModel;

enum User
{
    case Reader;
    case Origin;

    public function choose($model = null, $id = null)
    {
        return match($this) {
            User::Reader => $model->getById($id),
            User::Origin => $this->checkGuest()
        };
    }

    private function checkGuest()
    {
        $accountModel = new AccountModel();
        return $accountModel->getCheckForm();
    }
}
