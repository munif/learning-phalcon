<?php

namespace App\Core\Models;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;

class CategoryTranslation extends Base
{
    public function initialize()
    {
        $this->belongsTo(
            'category_translation_category_id',
            'App\Core\Models\Category',
            'id',
            array(
                'foreignKey' => true,
                'reusable' => true,
                'alias' => 'category'
            )
        );
    }

    public function validation()
    {
        $validator = new Validation();
        
        $validator->add(
            "category_translation_slug",
            new Uniqueness([
                "message" => "Category slug should be unique"
            ])
        );

        return $this->validate($validator);
    }
    public function beforeValidation()
    {
        if ($this->category_translation_slug == '') {
            $this->category_translation_slug = $this->category_translation_name . '-' . $this->category_translation_category_id;
        }
    }
}
