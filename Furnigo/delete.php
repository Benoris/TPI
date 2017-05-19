<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(!isset($_SESSION['name'])){
session_start();
}
require_once 'users.php';
ifAdmin($_SESSION['mode']);

$id = filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);

$result = DeleteUser($id);

if($result){
    header("Location: adminoptions.php?msg=1");
    exit;
}
else{
    header("Location: adminoptions.php?msg=2");
    exit;
}