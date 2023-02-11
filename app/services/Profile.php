<?php

namespace Tsel\Blog\services;

enum Profile
{
    case Specified;
    case Modified;
    public function choose($model)
    {
       $accountId = $model->getAccountIdByCookie();
       match ($this) {
            Profile::Specified => $model->getProfile($accountId),
            Profile::Modified => $this->represent($accountId, $model),
        };
    }

    public function represent($accountId, $model) {
        $avatar = $model->uploadFile();
        $model->updateProfile($accountId, $avatar);
    }
}
