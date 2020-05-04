<?php

declare(strict_types=1);

namespace App\Tasks;

use Phalcon\Cli\Task;

class UserTask extends Task
{
    public function createAction($firstName, $lastName, $email, $password, $isActive, $profileLocation, $profileBirthday)
    {
        $manager = $this->di->get('core_user_manager');
        try {
            $user = $manager->create(array(
                'user_first_name' => $firstName,
                'user_last_name' => $lastName,
                'user_email' => $email,
                'user_password' => $password,
                'user_is_active' => $isActive,
                'user_profile_location' => $profileLocation,
                'user_profile_birthday' => $profileBirthday,
            ));

            echo "User ". $user->user_first_name . " " . $user->user_last_name . " has been created. ID: " . $user->id . "\n";

        } catch (\Exception $e) {
            echo "There were some errors creating the user. <br>";

            var_dump($e->getMessage());
        }
    }
}
