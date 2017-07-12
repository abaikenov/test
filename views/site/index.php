<?php
/** @var integer $page */
/** @var array $tasks */
?>
<h1>Список задач</h1>
<hr>


<a href="<?= \core\Url::to('site/new')?>" class="btn btn-success" style="margin-bottom: 15px">Создать</a>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th style="white-space: nowrap">Имя пользователя
            <a href="<?= \core\Url::to('site/index', ['sort' => 'user ASC'], true)?>"><i class="glyphicon glyphicon-sort-by-alphabet"></i></a>
            <a href="<?= \core\Url::to('site/index', ['sort' => 'user DESC'], true)?>"><i class="glyphicon glyphicon-sort-by-alphabet-alt"></i></a>
        </th>
        <th>Email
            <a href="<?= \core\Url::to('site/index', ['sort' => 'email ASC'], true)?>"><i class="glyphicon glyphicon-sort-by-alphabet"></i></a>
            <a href="<?= \core\Url::to('site/index', ['sort' => 'email DESC'], true)?>"><i class="glyphicon glyphicon-sort-by-alphabet-alt"></i></a>
        </th>
        <th>Заголовок</th>
        <th>Текст</th>
        <th>Картинка</th>
        <th style="white-space: nowrap">Статус
            <a href="<?= \core\Url::to('site/index', ['sort' => 'status ASC'], true)?>"><i class="glyphicon glyphicon-sort-by-alphabet"></i></a>
            <a href="<?= \core\Url::to('site/index', ['sort' => 'status DESC'], true)?>"><i class="glyphicon glyphicon-sort-by-alphabet-alt"></i></a>
        </th>
        <?php if(core\Session::get('loggedIn')):?>
            <th></th>
        <?php endif;?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?= $task->getId()?></td>
            <td><?= $task->getUser()?></td>
            <td><?= $task->getEmail()?></td>
            <td><?= $task->getTitle()?></td>
            <td><?= $task->getText()?></td>
            <td><img src="<?= $task->getImage()?>" alt="<?= $task->getTitle()?>" title="<?= $task->getTitle()?>" /></td>
            <td>
                <?php if($task->getStatus()):?>
                    <span class="btn btn-success">решено</span></td>
                <?php else:?>
                    <span class="btn btn-default">не решено</span></td>
                <?php endif;?>
            <?php if(core\Session::get('loggedIn')):?>
                <td><a class="btn btn-primary" href="<?= \core\Url::to('site/edit', ['id' => $task->getId()])?>"><i class="glyphicon glyphicon-pencil"></i></a></td>
            <?php endif;?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<nav class="text-center">
    <ul class="pagination">
        <?php if (1 === $page):?>
            <li class="disabled">
            <span>
                <span aria-hidden="true">&laquo;</span>
            </span>
            </li>
        <?php else: ?>
            <li>
                <a href="<?= \core\Url::to('site/index', ['page' => $page - 1], true)?>">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $pageCount; $i++): ?>
            <li class="<?= $page === $i ? 'active' : '' ?>"><a href="<?= \core\Url::to('site/index', ['page' => $i], true)?>"><?= $i ?></a></li>
        <?php endfor; ?>
        <?php if ($pageCount === $page): ?>
            <li class="disabled">
            <span>
                <span aria-hidden="true">&raquo;</span>
            </span>
            </li>
        <?php else: ?>
            <li>
                <a href="<?= \core\Url::to('site/index', ['page' => $page + 1], true)?>">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>


