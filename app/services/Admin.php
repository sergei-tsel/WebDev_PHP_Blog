<?php

namespace Tsel\Blog\services;

use Tsel\Blog\models\AccountModel;

enum Admin
{
    case Verify;
    case Qualify;
    case Certify;

    public function choose($model, $id = null, $accountId = null)
    {
        match ($this) {
            Admin::Verify => null,
            Admin::Qualify, Admin::Certify => $this->resolve($accountId)
        };

        return $model->getProfile($id, true);
    }

    private function resolve($accountId) {
        $accountModel = new AccountModel();

        match($this) {
            Admin::Qualify => $accountModel->setAccountIsActive($accountId, false),
            Admin::Certify => $accountModel->setAccountIsActive($accountId),
        };
    }
}
