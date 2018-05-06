<?php

namespace App\Controllers;

require_once '../app/models/db.php';

class HomeController extends Controller {

	public function getHomepage($request, $response) {
		return $this->view->render($response, 'homepage.php');
	}

	public function authentificate($request, $response) {
		if (authentificate($request->getQueryParams())) {
			$_SESSION['usr'] = $request->getQueryParams()["usr"];
			return $response->withRedirect('/user');
		} else {
			$this->flash->addMessage('info', 'Username or password incorrect');
			return $response->withHeader('Location', '/');
		}
	}

	public function register($request, $response) {
		if ($request->getParsedBody()["passwd"] == $request->getParsedBody()["passwdRepeat"]) {
			if (register($request->getParsedBody())) {
				$_SESSION['usr'] = $request->getParsedBody()["usr"];
				return $response->withRedirect('/user');
			} else {
				$this->flash->addMessage('info', 'Username in use.');
				return $response->withHeader('Location', '/');
			}
		} else {
			$this->flash->addMessage('info', "Passwords don't match.");
			return $response->withHeader('Location', '/');
		}
	}

}
