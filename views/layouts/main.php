<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Тестовое задание</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/bootstrap-theme.css">
    <link rel="stylesheet" href="/css/jquery.fileupload.css">
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
<div class="col-md-8 col-md-offset-2">
    <?= $content ?>
</div>
<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/js/jquery.fileupload.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/script.js"></script>
</body>
</html>
