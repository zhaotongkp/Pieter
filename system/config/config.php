<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
return[
    "system" => [
        "db" => [
            'db_host' => "localhost",
            'db_user' => 'root',
            'db_password' => '',
            'db_database' => 'kopuuser',
            'db_table_status_prefix' => 'kp',
            'db_table_admin_prefix' => 'kp_admin',
            'db_charset' => 'utf-8',
            'db_conn' => '',
        ],
        'lib' => [
            'prefix' => 'my',
        ],
        'route' => [
            'default_controller' => 'home',
            'default_action' => 'index',
            'url_type' => 1,
        ],
        'cache' => [
            'cache_dir' => 'caching',
            'cache_prefix' => 'cache_',
            'cache_time' => 1800,
            'cache_mode' => 2,
        ],
    ]
];