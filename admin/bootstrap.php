<?php
    require_once '../libraries/Psr4AutoloaderClass.php';
    $loader = new Psr4AutoloaderClass;
    $loader->register();
    $loader->addNamespace('CT271\NLCS', '../model');
    require_once '../model/pdo_connect.php';
