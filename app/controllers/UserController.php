<?php

namespace App\Controllers;

class UserController extends Controller {

	public function getUserpage($request, $response) {
		if (isset($_SESSION["usr"])) {
			//Ask model for messages
			$data = $this->model->getMessages($_SESSION["usr"]);
			//Ask model for users
			$data["users"] = $this->model->getUsers($_SESSION["usr"]);
			//Render view user.php
			$this->view->render($response, 'user.php', $data);
		} else {
			//flash error message
			$this->flash->addMessage('info', "<p id='err'>You need to log in first.</p>");
			//redirect to homepage
			return $response->withHeader('Location', '/');
		}
	}

	public function postMsg($request, $response) {
		if ($this->model->sendMsg($request->getParsedBody()) === true) {
			$this->flash->addMessage('info', "<p id='info'>Message sent.</p>");
		} else {
			$this->flash->addMessage('info', "<p id='err'>There was an unexpected error.</p>");
		}
		return $response->withHeader('Location', '/user');
	}
	
	public function logOut($request, $response) {
        $_SESSION["usr"]=null;
		$this->flash->addMessage('info', "<p id='info'>You've logged out, good bye!</p>");
		return $response->withHeader('Location', '/');
	}
}