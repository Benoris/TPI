<?php

/*
  Projet: Site de déménagement
  Auteur:     Maurice Dinh
  Classe:     I.IN-P4B
  Titre:      adduser.php
  Description: Fichier d'ajout d'un utilisateur suivie d'une redirection avec un message
 * Ce fichier filtres les input post avant de les stocker dans des variables pour les réutiliser comme paramètre dans la fonction
  Date:       24/05/2017
 */

require 'users.php';

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

$add = AddUser($pseudo, $mail, $hashpwd);
if ($add) {
    header("Location:index.php");
    exit;
} else {
    header("Location:index.php?msg=9");
    exit;
}