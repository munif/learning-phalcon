<?php

namespace App\Core\Models;
use Phalcon\Mvc\Model\Behavior\Timestampable;

class UserProfile extends Base
{
    public function initialize()
    {
        $this->hasOne(
            'user_profile_user_id',
            'App\Core\Models\User',
            'id',
            array(
                'alias' => 'user',
                'reusable' => true
            )
        );

        $this->addBehavior(new Timestampable(array(
            'beforeValidationOnCreate' => array(
                'field' => 'user_profile_created_at',
                'format' => 'Y-m-d H:i:s'
            ),
            'beforeValidationOnUpdate' => array(
                'field' => 'user_profile_updated_at',
                'format' => 'Y-m-d H:i:s'
            ),
        )));
    }
}
