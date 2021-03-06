<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;
use application\models\Admin;

class MainController extends Controller {

	public function indexAction() {
		$this->view->render('Главная страница');
	}

	public function aboutAction() {
		$this->view->render('Обо мне');
	}

	public function contactAction() {
		if (!empty($_POST)) {
			if (!$this->model->contactValidate($_POST)) {
				$this->view->message('error', $this->model->error);
			}
			mail("tefija4774@sc2hub.com", 'Сообщение из блога.', $_POST['name'] . '|' . $_POST['email'] . '|' . $_POST['text']);
			$this->view->message('success', 'Сообщение отправлено администратору.');
		}
		$this->view->render('Контакты');
	}

	public function postAction() {
		$this->view->render('Пост');
	}

}