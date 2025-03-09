<?php

namespace App\Enums\Users;

enum UserStatusEnum: string
{
    case Active = 'ACTIVE';
    case Blocked = 'BLOCKED';
    case Deleted = 'DELETED';

}
