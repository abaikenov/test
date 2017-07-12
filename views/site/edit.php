<?php
/** @var \models\Task $task */
?>
<h1>Задача - <?= $task->getTitle()?></h1>
<hr>

<form class="form-horizontal" method="post">
    <div class="form-group">
        <label for="text" class="col-sm-2 control-label">Текст</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="text" name="text" placeholder="Текст" rows="5"><?= $task->getText()?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="1" name="status" <?= $task->getStatus() ? 'checked' : ''?>> решено
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </div>
</form>

