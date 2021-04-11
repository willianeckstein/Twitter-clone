<?php
	namespace App\Controllers;
	use MF\Controller\Action;
	use MF\Model\Container;

	class AppController extends Action {
		public function timeline() {
			$this->validaAutenticacao();

			$tweet =  Container::getModel('tweet');
			$tweet->__set('id_usuario', $_SESSION['id']);

			$this->view->tweets = $tweet->getAll();
			$this->render('timeline');
		}

		public function tweet() {
			$this->validaAutenticacao();

			$tweet = Container::getModel('tweet');
			$tweet->__set('tweet', $_POST['tweet']);
			$tweet->__set('id_usuario', $_SESSION['id']);
			$tweet->salvar();

			header('location: /timeline');
		}

		public function validaAutenticacao() {
			session_start();

			if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == '') {
				header('location: /');
			}
		} 
	}
?>