<?php

require_once 'core/application.php';
require_once 'core/request.php';
require_once 'core/url.php';
require_once 'core/connection.php';
require_once 'core/session.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/model.php';
require_once 'models/task.php';
require_once 'models/user.php';

(new \core\Application())->handleRequest();
