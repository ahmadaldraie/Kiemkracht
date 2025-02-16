<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Klant extends Model
{
    /**
     * De naam van de table in de databank
     *
     * @var string
     */
    protected $table = 'klanten';

    /**
     * De attributen die ingevuld moeten worden bij het aanmaken van een klant
     * @var list<string>
     */
    protected $fillable = [
        'voornaam',
        'achternaam',
        'email',
    ];

    /**
    * haal de kassatickets die gekoppeld zijn aan de klant.
    * @return \Illuminate\Database\Eloquent\Relations\HasMany.
    */
    public function kassatickets() :HasMany {
        return $this->hasMany(Kassaticket::class);
    }
}
