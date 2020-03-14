<?php



require_once '../public/System/System.php';



$System = new System ();

$System->httpMethod = $_SERVER['REQUEST_METHOD'];

$System->uri = $_SERVER['REQUEST_URI'];

$System->Run();