<?php

namespace App\Enums;

enum Roles: string
{
    case Customer = 'customer';
    case Editor = 'editor';
    case Manager = 'manager';
    case Admin = 'super-admin';
}
