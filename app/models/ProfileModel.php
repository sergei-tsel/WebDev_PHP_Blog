<?php
namespace Tsel\Blog\models;

use Tsel\Blog\core\Model;

class ProfileModel extends Model
{

    const SQL_SET_PROFILE = "INSERT INTO profile (id_account) VALUES (:account)";
    const SQL_GET_PROFILE_ACCOUNT = "SELECT id FROM account WHERE login = :login AND password = :password";

    const SQL_GET_PROFILE_BY_ACCOUNT_ID = "SELECT * FROM profile WHERE id_account = :account";
    const SQL_GET_PROFILE_BY_ID = "SELECT * FROM profile WHERE id = :id";

    const SQL_UPDATE_PROFILE = "UPDATE profile SET name = :name, surname = :surname, dt_birth = :birth, sex = :sex, phone = :phone, email = :email, href_avatar = :avatar WHERE id_account = :account";
    const SQL_DELETE_PROFILE = "DELETE FROM profile WHERE id = :id";

    public function setProfile($accountId)
    {
        parent::$dataBase->setBasePrepare(self::SQL_SET_PROFILE, ['account' => $accountId]);
    }

    public function getAccountIdByCookie()
    {
        return parent::$dataBase->getBasePrepare(self::SQL_GET_PROFILE_ACCOUNT, ['login' => $_COOKIE['login'], 'password' => $_COOKIE['password']]);
    }

    public function getProfile($id, $visit = false)
    {
        if ($visit) {
            $profile = parent::$dataBase->getBasePrepare(self::SQL_GET_PROFILE_BY_ID, ['id' => $id]);
        } else {
            $profile = parent::$dataBase->getBasePrepare(self::SQL_GET_PROFILE_BY_ACCOUNT_ID, ['account' => $id]);
        }
        return ['id' => $profile[0]['id'], 'account' => $profile['0']['id_account'], 'name' => $profile['0']['name'], 'surname' => $profile['0']['surname'], 'birth' => $profile['0']['dt_birth'], 'sex' => $profile['0']['sex'], 'phone' => $profile['0']['phone'], 'email' => $profile['0']['email'], 'avatar' => $profile['0']['href_avatar']];
    }

    public function getForm()
    {
        return ['name' => '', 'surname' => '', 'birth' => '', 'sex' => '', 'phone' => '', 'email' => ''];
    }

    public function updateProfile($accountId, $avatar)
    {
        $name = $_POST['name'] ?? '';
        $surname = $_POST['surname'] ?? '';
        $birth = $_POST['birth'] ?? '';
        $sex = $_POST['sex'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $email = $_POST['email'] ?? '';

        parent::$dataBase->setBasePrepare(self::SQL_UPDATE_PROFILE, ['name' => $name, 'surname' => $surname, 'birth' => $birth, 'sex' => $sex, 'phone' => $phone, 'email' => $email, 'avatar' => $avatar, 'account' => $accountId]);
    }

    public function deleteProfile($id) {
        parent::$dataBase->setBasePrepare(self::SQL_DELETE_PROFILE, ['id' => $id]);
    }

    public function uploadFile() {
        $upload_dir = './upload/';

        $avatar_name = $_FILES["avatar"]["name"];
        $avatar_tmp_name = $_FILES["avatar"]["tmp_name"];
        $error = $_FILES["avatar"]["error"];

        $random_name = rand(1000,1000000)."-".$avatar_name;
        $upload_name = $upload_dir.strtolower($random_name);
        $upload_name = preg_replace('/\s+/', '-', $upload_name);

        if(move_uploaded_file($avatar_tmp_name, $upload_name)) {
            $response = array(
                "status" => "success",
                "error" => false,
                "message" => "File uploaded successfully",
                "url" => $upload_dir."/".$upload_name
            );
        } else {
            $response = array(
                "status" => "error",
                "error" => true,
                "message" => "Error uploading the file!"
            );
        }

        return "/upload/$random_name";
    }
}