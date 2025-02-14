<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Klant extends Model
{
    /**
     * @var list<string>
    */
    protected $fillable = [
        'voornaam',
        'achternaam',
        'email',
    ];

    public function kassatickets() :HasMany {
        return $this->hasMany(Kassaticket::class);
    }
}
