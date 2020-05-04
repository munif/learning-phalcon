<?php

declare(strict_types=1);

namespace App\Tasks;

use Phalcon\Cli\Task;

class ArticleTask extends Task
{
    public function createAction()
    {
        $manager = $this->di->get('core_article_manager');

        try {
            $article = $manager->create(array(
                // ganti dengan user id yang ada di tabel masing-masing
                'article_user_id' => 11
            ));

            echo "The article has been created. ID: ". $article->id . "\n";
            
        } catch (\Exception $e) {
            echo "There were some errors creating the article: \n";
            echo $e->getMessage() . "\n";
            
            $errors = json_decode($e->getMessage(), true);
            if (is_array($errors)) {
                foreach ($errors as $error) {
                    echo " - ". $error. "\n";
                }
            } else {
                echo " - ". $errors. "\n";
            }
        }
    }

    public function createCategoryAction()
    {
        $manager = $this->di->get('core_category_manager');
        try {
            $category = $manager->create(array());
            echo "The category has been created. ID: " . $category->id . "\n";
        } catch (\Exception $e) {
            echo "There were some errors creating the category: ";
            $errors = json_decode($e->getMessage(), true);
            if (is_array($errors)) {
                foreach ($errors as $error) {
                    $this->consoleLog(" - $error", "red");
                }
            } else {
                $this->consoleLog(" - $errors", "red");
            }
        }
    }
}
