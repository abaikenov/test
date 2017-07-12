<h1>Новая задача</h1>
<hr>

<form id="form-task" class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user" class="col-sm-2 control-label">Имя пользователя</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="user" name="user" required placeholder="Имя пользователя">
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" required placeholder="Email">
        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">Заголовок</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="title" name="title" required placeholder="Заголовок">
        </div>
    </div>
    <div class="form-group">
        <label for="text" class="col-sm-2 control-label">Текст</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="text" name="text" placeholder="Текст" rows="5"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="text" class="col-sm-2 control-label">Картинка</label>
        <div class="col-sm-10">
            <input type="hidden" name="image"/>
            <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>Select files...</span>
                <input id="fileupload" type="file" name="file" accept="image/jpeg,image/png,image/gif">
            </span>
            <br>
            <br>
            <div id="progress" class="progress">
                <div class="progress-bar progress-bar-success"></div>
            </div>
            <div id="output" class="files"></div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Создать</button>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#preview">Предосмотр</button>
        </div>
    </div>
</form>

<div class="modal fade" id="preview" tabindex="-1" role="dialog" aria-labelledby="previewLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Предварительный просмотр</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="white-space: nowrap">Имя пользователя</th>
                        <th>Email</th>
                        <th>Заголовок</th>
                        <th>Текст</th>
                        <th style="white-space: nowrap">Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="field-user"></span></td>
                            <td><span class="field-email"></span></td>
                            <td><span class="field-title"></span></td>
                            <td><span class="field-text"></span></td>
                            <td><span class="btn btn-default">не решено</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>