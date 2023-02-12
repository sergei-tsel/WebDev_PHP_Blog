<?php

namespace Tsel\Blog\services;

use Tsel\Blog\models\ProfileModel;

enum News
{
    case Writing;
    case Reading;

    public function choose($model, $href = null) {
        return match($this) {
            case News::Writing => $this->process($model),
            case News::Reading => $model->getNewsByHref($href)
        };
    }

    private function process($model)
    {
        $profileModel = new ProfileModel();
        $accountId = $profileModel->getAccountIdByCookie();
        $profile = $profileModel->getProfile($accountId);
        $model->setNews($profile[0]['id']);
    }
}
