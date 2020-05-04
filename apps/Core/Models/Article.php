<?php

namespace App\Core\Models;

use Phalcon\Mvc\Model\Behavior\Timestampable;

class Article extends Base
{
    public function initialize()
    {
        $this->hasMany(
            'id',
            'App\Core\Models\ArticleTranslation',
            'article_translation_article_id',
            array(
                'alias' => 'translations',
                'foreignKey' => true
            )
        );
        $this->hasOne(
            'article_user_id',
            'App\Core\Models\User',
            'id',
            array(
                'alias' => 'user',
                'reusable' => true
            )
        );
        
        $this->hasManyToMany(
            "id",
            "App\Core\Models\ArticleCategoryArticle",
            "article_id",
            "category_id",
            "App\Core\Models\Category",
            "id",
            array(
                'alias' => 'categories'
            )
        );

        $this->addBehavior(new Timestampable(array(
            'beforeValidationOnCreate' => array(
                'field' => 'article_created_at',
                'format' => 'Y-m-d H:i:s'
            ),
            'beforeValidationOnUpdate' => array(
                'field' => 'article_updated_at',
                'format' => 'Y-m-d H:i:s'
            ),
        )));
    }
}