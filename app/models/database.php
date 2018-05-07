<?php

class Database {

    private $_con;
    private $db_type = "mysql";
    private $host = "localhost";
    private $db_name = "slimapp";
    private $username = "root";
    private $password = "";

    public function __construct() {
        $this->_con = new PDO("$this->db_type:host=$this->host;dbname=$this->db_name", "$this->username", "$this->password");
        $this->_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->_con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function register($data) {
        $hash = password_hash($data["passwd"], PASSWORD_BCRYPT);
        $compUser = "select usr from user where usr='" . $data["usr"] . "'";
        $result = $this->_con->query($compUser);
        if ($result !== null && $result->rowCount() > 0) {
            return "Username already in use.";
        } else {
            $query = "insert into user values (null,'" . $data["usr"] . "','$hash')";
            try {
                $resultInsert = $this->_con->exec($query);
            } catch (PDOException $e) {
                return "Unexpected error";
            }
            return true;
        }
    }

    public function authentificate($data) {
        $query = "select passwd from user where usr='" . $data["usr"] . "'";
        $hash = $this->_con->query($query)->fetch()["passwd"];
        if (password_verify($data["passwd"], $hash) && $hash !== null) {
            return true;
        } else {
            return false;
        }
    }

    public function getMessages($usr) {
        $query = "select * from message where sender='$usr' or receiver='$usr' order by idmsg desc";
        $result = $this->_con->query($query);
        while ($row = $result->fetch()) {
            if ($row["sender"] == $usr) {
                $messages["sent"][] = $row;
            } else {
                $messages["received"][] = $row;
            }
        }
        if (isset($messages)) {
            return $messages;
        } else {
            return array();
        }
    }

    public function getUsers($usr) {
        $query = "select usr from user where usr!='$usr'";
        $result = $this->_con->query($query);
        while ($row = $result->fetch()) {
            $users[] = $row;
        }
        return $users;
    }

    public function sendMsg($params) {
        $query = "insert into message values(null,'" . $params["sender"] . "','" . $params["receiver"] . "','" . $params["subject"] . "','" . $params["body"] . "')";
        try {
            $this->_con->exec($query);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }

}
