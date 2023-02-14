<?php

namespace Tsel\Blog\services;

use Tsel\Blog\models\ProfileModel;

enum News
{
    case Writing;
    case Reading;
    case Searching;
    case Listing;
    case Marking;

    public function choose($model, $href = null)
    {
        return match ($this) {
            News::Writing => $this->process($model),
            News::Reading => $model->process($href),
            News::Searching => $model->searchNewsAndAuthors(),
            News::Listing => $model->getLatestNewsList(),
            News::Marking => $this->process($model, $href)
        };
    }

    private function process($model, $href = null)
    {
        $profileModel = new ProfileModel();
        $accountId = $profileModel->getAccountIdByCookie();
        $profile = $profileModel->getProfile(accountId: $accountId);

        $result = match ($this) {
            News::Writing => $model->setNews($profile['id']),
            News::Reading => $model->getNewsByHref($href, $profile['id']),
            News::Marking => $model->setLike($href, $profile['id'])
        };

        if($this === News::Marking) {
            return $model->setNews($profile[0]['id']);
        } else {
            return $result;
        }
    }

}
