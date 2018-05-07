<?php

namespace App\Controllers;

class HomeController extends Controller {
    /* This controller will manage requests related to the homepage. */

    public function getHomepage($request, $response) {
        /* Calls view from DIC, renders homepage.php */

        return $this->view->render($response, 'homepage.php');
    }

    public function authentificate($request, $response) {
        /* Handles login, asks model if user and password are correct, 
          if so initializes a session variable with the username and redirects to userpage,
          otherwise adds a flash message to response and redirects to homepage */

        if ($this->model->authentificate($request->getQueryParams()) === true) {
            $_SESSION['usr'] = $request->getQueryParams()["usr"];
            return $response->withRedirect('/user');
        } else {
            $this->flash->addMessage('info', "<p id='err'>Username or password incorrect</p>");
            return $response->withHeader('Location', '/');
        }
    }

    public function register($request, $response) {
        /* Handles register of users, checks passwords inputs to be equal, if so asks model to insert it, 
          model can answer with either true or a string with the error,
          if there is an error a flash message is added to response, otherwise a session */

        if ($request->getParsedBody()["passwd"] == $request->getParsedBody()["passwdRepeat"]) {

            if ($this->model != null) {
                if (($result = $this->model->register($request->getParsedBody())) === true) {
                    $_SESSION['usr'] = $request->getParsedBody()["usr"];
                    return $response->withRedirect('/user');
                } else {
                    $this->flash->addMessage('info', "<p id='err'>$result</p>");
                    return $response->withHeader('Location', '/');
                }
            } else {
                $this->flash->addMessage('info', "<p id='err'>Database connection failed.</p>");
                return $response->withHeader('Location', '/');
            }
        } else {
            $this->flash->addMessage('info', "<p id='err'>Passwords don't match.</p>");
            return $response->withHeader('Location', '/');
        }
    }

}
