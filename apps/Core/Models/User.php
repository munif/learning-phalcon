<?php

namespace App\Core\Models;

use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\Email;

class User extends Base
{

    public function initialize()
    {
        $this->hasOne(
            'id',
            'App\Core\Models\UserProfile',
            'user_profile_user_id',
            array(
                'alias' => 'profile',
                'reusable' => true
            )
        );

        $this->hasOne(
            'user_group_id',
            'App\Core\Models\UserGroups',
            'id',
            array(
                'alias' => 'group',
                'reusable' => true
            )
        );

        $this->addBehavior(new Timestampable(array(
            'beforeValidationOnCreate' => array(
                'field' => 'user_created_at',
                'format' => 'Y-m-d H:i:s'
            ),
            'beforeValidationOnUpdate' => array(
                'field' => 'user_updated_at',
                'format' => 'Y-m-d H:i:s'
            ),
        )));
    }

    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'user_email',
            new Email([
                "message" => "Invalid email address"
            ])
        );

        $validator->add(
            'user_email',
            new Uniqueness([
                "message" => "The email is already registered"
            ])
        );

        return $this->validate($validator);
    }
}
