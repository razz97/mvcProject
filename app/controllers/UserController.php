<?php

namespace App\Controllers;

require_once '../app/models/db.php';

class UserController extends Controller {

	public function getUserpage($request, $response) {
		if (isset($_SESSION["usr"])) {
			//Ask model for messages
			$data = getMessages($_SESSION["usr"]);
			//Ask model for users
			$data["users"] = getUsers($_SESSION["usr"]);
			//Render view user.php
			$this->view->render($response, 'user.php', $data);
		} else {
			//flash error message
			$this->flash->addMessage('info', 'You need to log in first.');
			//redirect to homepage
			return $response->withHeader('Location', '/');
		}
	}

	public function postMsg($request, $response) {
		if (sendMsg($request->getParsedBody()) === true) {
			$this->flash->addMessage('info', "Message sent.");
		} else {
			$this->flash->addMessage('info', "There was an unexpected error.");
		}
		return $response->withHeader('Location', '/user');
	}
	
	public function logOut($request, $response) {
//		session_destroy();
        $_SESSION["usr"]=null;
//		session_start();
		$this->flash->addMessage('info', "You've logged out, good bye!");
		return $response->withHeader('Location', '/');
	}
}