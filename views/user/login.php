<h1>Авторизация</h1>
<hr>

<form class="form-horizontal" method="post">
    <div class="form-group">
        <label for="username" class="col-sm-2 control-label">Логин</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="login" value="<?= $username?>" name="username" required placeholder="Логин">
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-2 control-label">Пароль</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Войти</button>
        </div>
    </div>
</form>

