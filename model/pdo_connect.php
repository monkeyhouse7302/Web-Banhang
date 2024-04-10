<?php
    try {
        $PDO = (new CT271\NLCS\PDOFactory)->create([
            'dbhost' => 'localhost',
            'dbname' => 'ct271_nlcs',
            'dbuser' => 'root',
            'dbpass' => ''
        ]);
    } catch (Exception $e) {
        echo 'Không thể kết nối đến MySQL! Kiểm tra lại username và password đến MySQL.<br>';
        exit("<pre>${e}</pre>");
    }
