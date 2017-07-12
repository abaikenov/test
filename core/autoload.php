<?php

require_once 'const.php';
require_once DIR_LIB . 'Application.php';
require_once DIR_LIB . 'Request.php';
require_once DIR_LIB . 'Url.php';
require_once DIR_LIB . 'Connection.php';
require_once DIR_LIB . 'Session.php';
require_once DIR_LIB . 'View.php';
require_once DIR_LIB . 'Controller.php';
require_once DIR_LIB . 'Model.php';
require_once DIR_MODELS . 'Task.php';
require_once DIR_MODELS . 'User.php';
require_once DIR_CONFIG . 'db.php';

(new \core\Application())->handleRequest();
