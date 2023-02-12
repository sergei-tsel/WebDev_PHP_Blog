<?php

namespace Tsel\Blog\services;

use Tsel\Blog\models\AccountModel;
use Tsel\Blog\models\NewsModel;

enum Profile
{
    case Specified;
    case Modified;
    case Disconnected;
    case Removed;

    public function choose($model)
    {
       $accountId = $model->getAccountIdByCookie();

       return match ($this) {
            Profile::Specified => $model->getProfile($accountId),
            Profile::Modified => $this->represent($accountId, $model),
            Profile::Disconnected => $this->disconnect(),
            Profile::Removed => $this->deleteAccountAndProfile($model)
       };
    }

    public function represent($accountId, $model) {
        $avatar = $model->uploadFile();
        $model->updateProfile($accountId, $avatar);
    }

    public function disconnect() {
        header_remove('Location: /index.php');
        session_write_close();
        $newsModel = new NewsModel();
        return $newsModel->getData();
    }

    public function deleteAccountAndProfile($model)
    {
        $accountId = $model->getAccountIdByCookie();
        $profile = $model->getProfile($accountId);
        $model->deletePofile($profile['id']);
        $accountModel = new AccountModel();
        $accountModel->delete($accountId);
        $newsModel = new NewsModel();
        return $newsModel->getData();
    }
}
