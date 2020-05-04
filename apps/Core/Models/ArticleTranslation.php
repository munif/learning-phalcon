<?php

namespace App\Core\Models;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;

class ArticleTranslation extends Base
{
    public function initialize()
    {
        $this->belongsTo(
            'article_translation_article_id',
            'App\Core\Models\Article',
            'id',
            array(
                'foreignKey' => true,
                'reusable' => true,
                'alias' => 'article'
            )
        );
    }
    public function validation()
    {

        $validator = new Validation();
        
        $validator->add(
            "article_translation_slug",
            new Uniqueness([
                "message" => "Article slug should be unique"
            ])
        );

        return $this->validate($validator);
    }

    public function beforeValidation()
    {
        if ($this->article_translation_slug == '') {
            $this->article_translation_slug = $this->article_translation_short_title . '-' . $this->article_translation_article_id;
        }
    }
}
