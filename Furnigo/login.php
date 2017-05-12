<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once 'users.php';
require_once 'message.php';

if (isset($_POST['send'])) {
    $pseudo = trim(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING));
    $pwd = trim(filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING));
    $hashpwd = sha1($pwd);
    $sess = CheckUserId($pseudo,$hashpwd);
    if ($sess) {
        session_start();
        $_SESSION['name'] = $sess[0]['Login'];
        $_SESSION['idUser'] = $sess[0]['idClient'];
        header("Location: index.php");
    }
    else{
        SetMessage("Pseudo ou mot de passe erroné");
    }
}
