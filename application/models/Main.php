<?php

namespace Application\Models;

use Application\Core\Model;

class Main extends Model
{
    public $error;

    public function contactValidate($post)
    {
        $nameLen = iconv_strlen($post['name']);
        $textLen = iconv_strlen($post['text']);
        $email = $post['email'];
        if ($nameLen < 3 || $nameLen > 100) {
            $this->error = "Имя должно быть больше 3 и меньше 100 символов. Сейчас ($nameLen) символов.";
            return false;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error = "Пожалуйста введите корректный email.";
            return false;
        } elseif ($textLen < 10 || $textLen > 500) {
            $this->error = "Текст сообщения должен быть больше 10 и меньше 500 символов. Сейчас ($textLen) символов.";
            return false;
        } else {
            return true;
        }
    }
}