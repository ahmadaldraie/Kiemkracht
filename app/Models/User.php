<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * De attributen die ingevuld moeten worden bij het aanmaken van een User
     *
     * @var list<string, bool>
     */
    protected $fillable = [
        'username',
        'password',
        'is_admin',
    ];

    /**
     * De attributen die verborgen moeten worden voor serialisatie.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * haal de attributen die gecast moeten worden.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_admin' => 'boolean',
            'password' => 'hashed',
        ];
    }
}
