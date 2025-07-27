<?php

namespace App\Enums;

enum LogActions: string
{
    case CREATED = 'created';
    case UPDATED = 'updated';
    case DELETED = 'deleted';
}
