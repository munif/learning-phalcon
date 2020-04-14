<?php

namespace App\Frontend\Controllers;

class ArticleController extends BaseController
{
    public function indexAction()
    {
        return $this->dispatcher->forward(['action' => 'list']);
    }

    public function listAction()
    {
        // Dapatkan objek dari dependency container
        $article_manager = $this->getDI()->get(
            'core_article_manager'
        );

        // Sisipkan variabel articles ke dalam view
        // articles didapatkan dari fungsi find()
        // Aecara default, view yang dipanggil adalah Views/Default/article/list.volt
        $this->view->articles = $article_manager->find();
    }
}
