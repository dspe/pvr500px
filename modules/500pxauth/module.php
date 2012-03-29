<?php

$Module = array( 'name' => '500px Oauth part' );

$ViewList = array();
$ViewList['connect'] = array(
                        'script' => 'connect.php',
                        'params' => array( 'ClassAttributeId' ),
                        'functions' => array( 'connect' ));

$ViewList['callback'] = array(
                        'script' => 'callback.php',
                        'params' => array( 'ClassAttributeId' ),
                        'functions' => array( 'callback' ));

$FunctionList = array();
$FunctionList['connect'] = array();
$FunctionList['callback'] = array();

?>