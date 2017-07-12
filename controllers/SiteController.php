<?php

namespace controllers;

use core\Controller;
use core\Model;
use core\Session;
use core\Url;
use Exception;
use finfo;
use models\Task;
use RuntimeException;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $limit = 3;
        $page = intval($this->request->get('page', 1));
        $sort = $this->request->get('sort', 'id DESC');

        $tasks = Model::find(Task::class, [
            'offset' => ($page - 1) * $limit,
            'limit' => $limit,
            'sort' => $sort,
        ]);

        $count = Model::count(Task::class);
        $pageCount = intval(ceil($count / $limit));

        $this->render('index', [
            'tasks' => $tasks,
            'sort' => $sort,
            'page' => $page,
            'pageCount' => $pageCount
        ]);
    }

    public function actionNew()
    {
        if ($this->request->isPost()) {
            if (Model::create(Task::class, array_merge($this->request->post(), ['createdAt' => date('Y-m-d H:i:s'), 'updatedAt' => date('Y-m-d H:i:s')])))
                $this->redirect(Url::to('site/index'));
        }
        $this->render('new');
    }

    public function actionEdit()
    {
        if (!Session::get('loggedIn'))
            $this->redirect(Url::to('site/index'));

        $task = Model::findById(Task::class, $this->request->get('id'));
        if (null === $task)
            $this->redirect(Url::to('site/index'));

        if ($this->request->isPost()) {
            if (Model::update($task, array_merge($this->request->post(), ['status' => $this->request->post('status', 0), 'updatedAt' => date('Y-m-d H:i:s')])))
                $this->redirect(Url::to('site/index'));
        }

        $this->render('edit', ['task' => $task]);
    }

    public function actionUpload()
    {
        try {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                    $finfo->file($_FILES['file']['tmp_name']),
                    array(
                        'jpg' => 'image/jpeg',
                        'png' => 'image/png',
                        'gif' => 'image/gif',
                    ),
                    true
                )
            ) {
                throw new RuntimeException('Invalid image format.');
            }

            $fileName = sha1_file($_FILES['file']['tmp_name']);
            if (!move_uploaded_file(
                $_FILES['file']['tmp_name'],
                sprintf('./uploads/%s.%s',
                    $fileName,
                    $ext
                )
            )
            ) {
                throw new RuntimeException('Failed to move uploaded file.');
            }
            $filePath = '/uploads/' . $fileName . '.' . $ext;

            $absFilePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $fileName. '.' . $ext;

            switch($ext)
            {
                case "png":
                    $img = imagecreatefrompng($absFilePath);
                    break;
                case "gif":
                    $img = imagecreatefromgif($absFilePath);
                    break;
                default:
                    $img = imagecreatefromjpeg($absFilePath);
                    break;
            }

            $w = 320;
            $h = 240;
            $image['sizeX'] = imagesx($img);
            $image['sizeY'] = imagesy($img);

            if(($image['sizeX'] > $w) || ($image['sizeY'] > $h)) {
                $thumb = imagecreatetruecolor($w, $h);
                if ($h / $w > $image['sizeY'] / $image['sizeX']) {
                    imagecopyresampled($thumb, $img, 0, 0, ($image['sizeX'] - $w / $h * $image['sizeY']) / 2, 0, $w, $h, $w / $h * $image['sizeY'], $image['sizeY']);
                } else {
                    imagecopyresampled($thumb, $img, 0, 0, 0, ($image['sizeY'] - $h / $w * $image['sizeX']) / 2, $w, $h, $image['sizeX'], $h / $w * $image['sizeX']);
                }
                imagejpeg($thumb, $absFilePath, 90);
            }
            echo json_encode(['src' => $filePath]);

        } catch (RuntimeException $e) {
            echo $e->getMessage();
        }
    }

}