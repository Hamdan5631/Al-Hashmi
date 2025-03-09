<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Throwable;

class UserUpdateAction
{
    /**
     * @throws Throwable
     */
    public function execute(Collection $data, User $user): User
    {
        DB::beginTransaction();

        if ($data->has('name')) {
            $user->name = $data->get('name');
        }

        if ($data->has('email')) {
            $user->email = $data->get('email');
        }

        if ($data->has('mobile_country_code')) {
            $user->mobile_country_code = $data->get('mobile_country_code');
        }

        if ($data->has('mobile')) {
            $user->mobile = $data->get('mobile');
        }

        if ($data->has('profile_image')) {
            $file = $data->pull('profile_image');
            $fileName = 'USER_PROFILE_IMAGE'.time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('user-profile-images/', $fileName, 'public');

            $user->profile_image = $fileName;
        }

        $user->save();

        DB::commit();

        return $user;
    }
}
