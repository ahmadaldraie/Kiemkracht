<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kassaticket extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = ['bestaand', 'klant_id'];

    public function klant() :BelongsTo {
        return $this->belongsTo(Klant::class);
    }
}
