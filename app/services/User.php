<?php
namespace Tsel\Blog\services;

use Tsel\Blog\models\AccountModel;

enum User
{
    case Reader;
    case Origin;

    public function choose($model = null, $href = null)
    {
        return match($this) {
            User::Reader => $model->getNewsByHref($href),
            User::Origin => $this->checkGuest()
        };
    }

    private function checkGuest()
    {
        $accountModel = new AccountModel();
        return $accountModel->getCheckForm();
    }
}
