<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kassaticket extends Model
{
    /**
     * De attributen die ingevuld moeten worden bij het aanmaken van een kassaticket
     * @var array<int, string>
     */
    protected $fillable = ['bestaand', 'klant_id'];

    /**
    * haal de klant die gekoppeld is aan het kassaticket.
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
    */
    public function klant() :BelongsTo {
        return $this->belongsTo(Klant::class);
    }
}
