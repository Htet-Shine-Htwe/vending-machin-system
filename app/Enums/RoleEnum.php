<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case OFFICER = 'office';
    case USER = 'user';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Amin',
            self::OFFICER => 'Officer',
            self::USER => 'User',
        };
    }
}
