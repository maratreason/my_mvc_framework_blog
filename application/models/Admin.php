<?php

namespace Application\Models;

use Application\Core\Model;

class Admin extends Model
{
    public $error;

    public function loginValidate($post)
    {
        $config = require 'application/config/admin.php';
        if (($config['login'] != $post['login']) || ($config['password'] != $post['password'])) {
            $this->error = 'Логин или пароль указан неверно';
            return false;
        }
        return true;
    }
}