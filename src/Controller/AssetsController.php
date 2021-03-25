<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

/**
 * Assets Controller
 *
 */
class AssetsController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['index', 'img', 'plugins']);
    }

    public function index($filename)
    {
        return WWW_ROOT . DS . 'assets' . DS . $filename;
        // $this->response->type($type);
        $this->response->withFile(WWW_ROOT . DS . 'assets' . DS . $filename);

        return $this->response;

        // if (file_exists(WWW_ROOT . 'uploads' . DS . "chat" . DS . $filename)) {
        //     $file_path = WWW_ROOT . 'uploads' . DS . "chat" . DS . $filename;
        //     $this->response->file($file_path, array(
        //         'download' => true,
        //         'name' => $filename,
        //     ));
        //     return $this->response;
        // }
        // throw new NotFoundException('Could not find file');
    }

    public function img($filename)
    {
        // $this->response->type($type);
        $this->response->withFile(WWW_ROOT . DS . 'img' . DS . $filename);
        return $this->response;
    }

    public function plugins($filename)
    {
        // $this->response->type($type);
        $this->response->withFile(WWW_ROOT . DS . 'plugins' . DS . $filename);

        return $this->response;
    }
}
