<?php


if($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1'){
    // Local
    define('HTTP_HOST', 'http://'.$_SERVER['HTTP_HOST'].'/ProjetWf3-1'); // definition d'une constante HTTP_HOST
    $dbinfos = [
        'dbhost' => 'localhost',
        'dbname' => 'projetwf3-1',
        'dbuser' => 'root',
        'dbpass' => ''
    ];

}
else {
    // Prod
    define('HTTP_HOST', 'http://'.$_SERVER['HTTP_HOST']); // definition d'une constante HTTP_HOST
    $dbinfos = [
        'dbhost' => 'localhost',
        'dbname' => 'projetwf3-1',
        'dbuser' => 'user',
        'dbpass' => 'password'
    ];
}



$bdd = new PDO('mysql:host='.$dbinfos['dbhost'].';dbname='.$dbinfos['dbname'].';charset=utf8', $dbinfos['dbuser'], $dbinfos['dbpass']);