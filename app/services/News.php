<?php

namespace Tsel\Blog\services;

use Tsel\Blog\models\ProfileModel;

enum News
{
    case Writing;
    case Reading;
    case Searching;
    case Listing;

    public function choose($model, $href = null)
    {
        return match ($this) {
            News::Writing => $this->process($model),
            News::Reading => $model->getNewsByHref($href),
            News::Searching => $model->searchForNewsAndAuthors(),
            News::Listing => $model->getLatestNewsList()
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
