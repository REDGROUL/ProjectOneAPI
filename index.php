<?php
/**
 * Поиск и подключение всех классов
 * 
 */
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset: utf-8');
set_include_path(get_include_path().'/libs;');
spl_autoload_extensions('.php');
spl_autoload_register();
Router::start();//запуск 