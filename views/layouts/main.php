<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Тестовое задание</title>
    <link rel="stylesheet" href="/web/css/bootstrap.css">
    <link rel="stylesheet" href="/web/css/bootstrap-theme.css">
    <link rel="stylesheet" href="/web/css/jquery.fileupload.css">
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= \core\Url::to('/') ?>">Главная</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php if(!core\Session::get('loggedIn')):?>
                    <li><a href="<?= \core\Url::to('user/login') ?>">Войти</a></li>
                <?php else:?>
                    <li><a href="<?= \core\Url::to('user/logout') ?>">Выйти</a></li>
                <?php endif;?>
            </ul>
        </div>
    </div>
</nav>
<div class="col-md-10 col-md-offset-1">
    <?= $content ?>
</div>
<script type="text/javascript" src="/web/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/web/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/web/js/jquery.fileupload.js"></script>
<script type="text/javascript" src="/web/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/web/js/script.js"></script>
</body>
</html>
