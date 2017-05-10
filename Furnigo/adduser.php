<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'users.php';
require_once 'message.php';

$pseudo = trim(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING));
$mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
$pwd = trim(filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING));

/* J'ai essayé d'utiliser le Bcrypt mais celui-ci n'étant que disponibe à partir de la version 5.5 de PHP,
 * j'ai donc du me rabattre sur le sha1
 * password_hash est une fonction de cryptage prennant deux paramètres,
 * la chaine de caractère et le type d'algo à utiliser PASSWORD_BCRYPT/PASSWORD_DEFAULT
 * il y a une troisième option qui est le coût algorithmique du mdp
*/
$hashpwd = sha1($pwd);

$add = AddUser($pseudo,$mail,$hashpwd);
if($add){
    header("Location:index.php");
}
else{
    SetMessage("Impossible de créer le compte!");
}