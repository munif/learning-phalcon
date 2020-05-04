<?php

namespace App\Core\Models;
use Phalcon\Mvc\Model\Behavior\Timestampable;

class Category extends Base
{
    public function initialize()
    {

        $this->hasManyToMany(
            "id",
            "App\Core\Models\ArticleCategoryArticle",
            "category_id",
            "article_id",
            "App\Core\Models\Article",
            "id",
            array('alias' => 'articles')
        );
        $this->hasMany(
            'id',
            'App\Core\Models\CategoryTranslation',
            'category_translation_category_id',
            array(
                'alias' => 'translations',
                'foreignKey' => true
            )
        );
        $this->addBehavior(new Timestampable(array(
            'beforeValidationOnCreate' => array(
                'field' => 'category_created_at',
                'format' => 'Y-m-d H:i:s'
            ), 'beforeValidationOnUpdate' => array(
                'field' => 'category_updated_at',
                'format' => 'Y-m-d H:i:s'
            ),
        )));
    }
}
