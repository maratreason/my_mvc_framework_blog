<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;
use application\models\Main;

class AdminController extends Controller {

	public function __construct($route) {
		parent::__construct($route);
		$this->view->layout = 'admin';
	}

	public function loginAction() {
		if (!empty($_POST)) {
			if (!$this->model->loginValidate($_POST)) {
				$this->view->message('error', $this->model->error);
			}
			$_SESSION['admin'] = true;
			$this->view->location('admin/add');
		}
		$this->view->render('Вход');
	}

	public function addAction() {
		$this->view->render('Добавить');
	}

	public function editAction() {

		$this->view->render('Редактировать пост');
	}

	public function deleteAction() {

		$this->view->redirect('admin/posts');
	}

	public function logoutAction() {
		$this->view->redirect('admin/login');
	}

	public function postsAction() {
		$this->view->render('Посты');
	}
}