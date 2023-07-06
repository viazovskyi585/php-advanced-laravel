<?php

namespace App\Enums;

enum Roles: string
{
    case CUSTOMER = 'customer';
    case EDITOR = 'editor';
    case MANAGER = 'manager';
    case ADMIN = 'super-admin';
}
