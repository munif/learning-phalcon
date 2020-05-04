<?php

namespace App\Core\Managers;

use \App\Core\Models\Category;
use \App\Core\Models\CategoryTranslation;

class CategoryManager extends BaseManager
{
    public function create(array $input_data)
    {
        $default_data = array(
            'translations' => array(
                'en' => array(
                    'category_translation_name' => 'Category name',
                    'category_translation_slug' => '',
                    'category_translation_lang' => 'en',
                )
            ),
            'category_is_active' => 0
        );

        $data = array_merge($default_data, $input_data);
        
        $category = new Category();
        $category->category_is_active = $data['category_is_active'];
        
        $categoryTranslations = array();
        foreach ($data['translations'] as $lang => $translation) {
            $tmp = new CategoryTranslation();
            $tmp->assign($translation);
            array_push($categoryTranslations, $tmp);
        }
        $category->translations = $categoryTranslations;
        
        return $this->save($category, 'create');
    }
}