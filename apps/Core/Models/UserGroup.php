<?php

namespace App\Core\Models;

class UserGroup extends Base
{
    public function initialize()
    {
        $this->hasMany(
            'id',
            'App\Core\Models\User',
            'group_id',
            array(
                'alias' => 'users'
            )
        );
    }
}
