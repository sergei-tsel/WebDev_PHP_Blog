<?php
namespace Tsel\Blog\services;

enum User
{
    case Reader;
    case Origin;

    public function choose($id, $model)
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

    }
}
