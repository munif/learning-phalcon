<?php

namespace App\Core\Managers;

use App\Core\Models\User;
use App\Core\Models\UserGroup;
use App\Core\Models\UserProfile;

class UserManager extends BaseManager
{
    public function find($parameters = null)
    {
        return User::find($parameters);
    }
    /**
     * Create a new user
     *
     * @param array $data
     * @return string|\App\Core\Models\User
     */
    public function create($data, $user_group_name = 'User')
    {
       
        $security = $this->di->get('security');

        $user = new User();
        $user->user_first_name = $data['user_first_name'];
        $user->user_last_name = $data['user_last_name'];
        $user->user_email = $data['user_email'];
        $user->user_password = $security->hash($data['user_password']);
        $user->user_is_active = $data['user_is_active'];

        // set group id
        $user->user_group_id = $this->findFirstGroupByName($user_group_name)->id;

        //Set user profile
        $profile = new UserProfile();
        // Set value dari kolom user profile
        $profile->user_profile_location = $data['user_profile_location'];
        $profile->user_profile_birthday = $data['user_profile_birthday'];

        $user->profile = $profile;
        
        return $this->save($user);
    }

    public function findFirstGroupByName($user_group_name) {
        return UserGroup::findFirstByUserGroupName($user_group_name);
    }
}
