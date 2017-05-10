<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

static $msg;
function SetMessage($txtmsg){
    global $msg;
    $msg = $txtmsg;
}

function GetMessage(){
    global $msg;
    return $msg;
}