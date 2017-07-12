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
        $sort = $this->request->get('sort', 'createdAt DESC');

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
            if (!isset($_FILES['file']['error']) || is_array($_FILES['file']['error'])) {
                throw new RuntimeException('Invalid parameters.');
            }

            switch ($_FILES['file']['error'][0]) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }

            if ($_FILES['file']['size'] > 1000000) {
                throw new RuntimeException('Exceeded filesize limit.');
            }

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
                throw new RuntimeException('Invalid file format.');
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
            $filePath = '/uploads/' . $fileName. '.' . $ext;
//            echo $this->resizeImage(__DIR__ . '..' . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'uploadss' . DIRECTORY_SEPARATOR . $fileName. '.' . $ext, $filePath, 1, 320, 240);
            echo $this->resizeImage($filePath.'sd', $filePath, 1, 320, 240);

            echo json_encode(['src' => $filePath]);

        } catch (RuntimeException $e) {
            echo $e->getMessage();
        }
    }

    private function resizeImage($input, $output, $mode, $w, $h = 0)
    {
        switch($this->getMimeType($input))
        {
            case "image/png":
                $img = imagecreatefrompng($input);
                break;
            case "image/gif":
                $img = imagecreatefromgif($input);
                break;
            case "image/jpeg":
            default:
                $img = imagecreatefromjpeg($input);
                break;
        }

        $image['sizeX'] = imagesx($img);
        $image['sizeY'] = imagesy($img);
        switch ($mode){
            case 1: //Quadratic Image
                $thumb = imagecreatetruecolor($w,$w);
                if($image['sizeX'] > $image['sizeY'])
                {
                    imagecopyresampled($thumb, $img, 0,0, ($w / $image['sizeY'] * $image['sizeX'] / 2 - $w / 2),0, $w,$w, $image['sizeY'],$image['sizeY']);
                }
                else
                {
                    imagecopyresampled($thumb, $img, 0,0, 0,($w / $image['sizeX'] * $image['sizeY'] / 2 - $w / 2), $w,$w, $image['sizeX'],$image['sizeX']);
                }
                break;

            case 2: //Biggest side given
                if($image['sizeX'] > $image['sizeY'])
                {
                    $thumb = imagecreatetruecolor($w, $w / $image['sizeX'] * $image['sizeY']);
                    imagecopyresampled($thumb, $img, 0,0, 0,0, imagesx($thumb),imagesy($thumb), $image['sizeX'],$image['sizeY']);
                }
                else
                {
                    $thumb = imagecreatetruecolor($w / $image['sizeY'] * $image['sizeX'],$w);
                    imagecopyresampled($thumb, $img, 0,0, 0,0, imagesx($thumb),imagesy($thumb), $image['sizeX'],$image['sizeY']);
                }
                break;
            case 3; //Both sides given (cropping)
                $thumb = imagecreatetruecolor($w,$h);
                if($h / $w > $image['sizeY'] / $image['sizeX'])
                {
                    imagecopyresampled($thumb, $img, 0,0, ($image['sizeX']-$w / $h * $image['sizeY'])/2,0, $w,$h, $w / $h * $image['sizeY'],$image['sizeY']);
                }
                else
                {
                    imagecopyresampled($thumb, $img, 0,0, 0,($image['sizeY']-$h / $w * $image['sizeX'])/2, $w,$h, $image['sizeX'],$h / $w * $image['sizeX']);
                }
                break;

            case 0:
                $thumb = imagecreatetruecolor($w,$w / $image['sizeX']*$image['sizeY']);
                imagecopyresampled($thumb, $img, 0,0, 0,0, $w,$w / $image['sizeX']*$image['sizeY'], $image['sizeX'],$image['sizeY']);
                break;
        }

        if(!file_exists($output)) imagejpeg($thumb, $output, 90);
    }


    private function getMimeType($file)
    {
        $forbiddenChars = array('?', '*', ':', '|', ';', '<', '>');
        if(strlen(str_replace($forbiddenChars, '', $file)) < strlen($file))
            throw new Exception("Forbidden characters!");
        $file = escapeshellarg($file);
        ob_start();
        $type = system("file --mime-type -b ".$file);
        ob_clean();
        return $type;
    }
}