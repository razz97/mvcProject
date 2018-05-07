<?php

function conectar() {
    $connect = mysqli_connect("localhost", "root", "", "slimapp");
    if (!$connect) {
        die("No se ha podido establecer la conexión con el servidor");
    }
    return $connect;
}

function desconectar($connect) {
    mysqli_close($connect);
}

function authentificate($data) {
    $c = conectar();
    $query = "select passwd from user where usr='" . $data["usr"] . "'";
    $hash = mysqli_fetch_assoc(mysqli_query($c, $query))["passwd"];
    desconectar($c);
    if (password_verify($data["passwd"], $hash)) {
        return true;
    } else {
        return false;
    }
}

function register($data) {
    $c = conectar();
    $hash = password_hash($data["passwd"], PASSWORD_BCRYPT);
    $compUser = "select usr from user where usr='" . $data["usr"] . "'";
    if (mysqli_num_rows(mysqli_query($c, $compUser)) > 0) {
        $response = "Username already in use.";
    } else {
        $query = "insert into user values (null,'" . $data["usr"] . "','$hash')";
        $result = mysqli_query($c, $query);
        if ($result) {
            $response = true;
        } else {
            $response = mysqli_error($c);
        }
    }
    desconectar($c);
    return $response;
}

function getMessages($usr) {
    $c = conectar();
    $query = "select * from message where sender='alex' or receiver='alex' order by idmsg";
    $result = mysqli_query($c, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row["sender"] == $usr) {
            $messages["sent"][] = $row;
        } else {
            $messages["received"][] = $row;
        }
    }
    desconectar($c);
    if (isset($messages)) {
        return $messages;
    } else {
        return array();
    }
}

function getUsers($usr) {
    $c = conectar();
    $query = "select usr from user where usr!='$usr'";
    $result = mysqli_query($c, $query);
    while ($row = mysqli_fetch_array($result)) {
        $users[] = $row;
    }
    desconectar($c);
    return $users;
}

function sendMsg($params) {
    $c = conectar();
    $query = "insert into message values(null,'" . $params["sender"] . "','" . $params["receiver"] . "','" . $params["subject"] . "','" . $params["body"] . "')";
    $result = mysqli_query($c, $query);
    if ($result) {
        $response = true;
    } else {
        $response = mysqli_error($c);
    }
    desconectar($c);
    return $response;
}
