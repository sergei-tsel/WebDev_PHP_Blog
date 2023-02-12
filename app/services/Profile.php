<?php

namespace Tsel\Blog\services;

use Tsel\Blog\models\AccountModel;

enum Profile
{
    case Specified;
    case Modified;
    case Disconnected;
    case Removed;

    public function choose($model)
    {
       $accountId = $model->getAccountIdByCookie();

       match ($this) {
            Profile::Specified => null,
            Profile::Modified => $this->represent($accountId, $model),
            Profile::Disconnected => $this->disconnect(),
            Profile::Removed => $this->deleteAccountAndProfile($model)
       };

       if ($this === Profile::Specified) {
          return $model->getProfile($accountId);
       }
    }

    public function represent($accountId, $model) {
        $avatar = $model->uploadFile();
        $model->updateProfile($accountId, $avatar);
    }

    public function disconnect() {
        header_remove('Location: /index.php');
        session_write_close();
    }

    public function deleteAccountAndProfile($model)
    {
        $accountId = $model->getAccountIdByCookie();
        $profile = $model->getProfile($accountId);
        $model->deletePofile($profile['id']);
        $accountModel = new AccountModel();
        $accountModel->delete($accountId);
    }
}
