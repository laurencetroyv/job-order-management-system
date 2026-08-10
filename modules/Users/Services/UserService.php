<?php

namespace Modules\Users\Services;

use Modules\Users\Models\User;
use Modules\Users\Data\CreateUserData;
use Modules\Users\Data\UpdateUserData;

class UserService
{
    public function createUser(CreateUserData $data): User
    {
        $user = User::createOrFirst(['id' => $data->id], $data->all());

        if ($data->photo && isDataProvided($data->photo)) {
            $user->addAttachment($data->photo, 'profile', false, $user->id);
        }

        return $user;
    }

    public function updateUser(UpdateUserData $data, User $user): void
    {
        $user->update($data->all());

        if ($data->attachments && isDataProvided($data->attachments)) {
            $user->addAttachments($data->attachments, 'profile');
        }
    }
}
