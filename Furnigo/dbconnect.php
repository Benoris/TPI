<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
DEFINE('DB_HOST', "127.0.0.1");
DEFINE('DB_NAME', "db_demenagement");
DEFINE('DB_USER', "FurnigoUser");
DEFINE('DB_PASS', "1234");

function connectdb() {
    static $db = null;

    if ($db === null) {
        try {
            $connectionString = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
            $db = new PDO($connectionString, DB_USER, DB_PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    return $db;
}

