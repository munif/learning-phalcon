<?php

namespace App\Core\Managers;

use App\Core\Models\Article;
use App\Core\Models\ArticleTranslation;

class ArticleManager extends BaseManager
{
    public function create($input_data)
    {
        $default_data = array(
            'article_user_id' => 1,
            'article_is_published' => 0,
            'translations' => array(
                'en' => array(
                    'article_translation_short_title' => 'Short title',
                    'article_translation_long_title' => 'Long title',
                    'article_translation_description' => 'Description',
                    'article_translation_slug' => '',
                    'article_translation_lang' => 'en',
                )
            ),
            'categories' => array()
        );
        $data = array_merge($default_data, $input_data);

        $article = new Article();
        $article->article_user_id = $data['article_user_id'];
        $article->article_is_published = $data['article_is_published'];
        $articleTranslations = array();
        foreach ($data['translations'] as $lang => $translation) {
            $tmp = new ArticleTranslation();
            $tmp->assign($translation);
            array_push($articleTranslations, $tmp);
        }
        $article->translations = $articleTranslations;
        
        return $this->save($article, 'create');
    }

    public function find($parameters = null)
    {
        return Article::find($parameters);
    }

    public function update($id, $data)
    {
        $article = Article::findFirstById($id);
        if (!$article) {
            throw new \Exception('Article not found', 404);
        }

        $article->setArticleShortTitle($data['article_short_title']);
        $article->setUpdatedAt(new \Phalcon\Db\RawValue('NOW()'));
        
        if (false === $article->update()) {
            foreach ($article->getMessages() as $message) {
                $error[] = (string) $message;
            }
            throw new \Exception(json_encode($error));
        }
        return $article;
    }

    public function delete($id)
    {
        $article = Article::findFirstById($id);
        if (!$article) {
            throw new \Exception('Article not found', 404);
        }
        if (false === $article->delete()) {
            foreach ($article->getMessages() as $message) {
                $error[] = (string) $message;
            }
            throw new \Exception(json_encode($error));
        }
        return true;
    }
}
