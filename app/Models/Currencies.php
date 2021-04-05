<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\CurrencyUpdated;

class Currencies extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'currencies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['сhar_сode', 'name', 'rate'];


    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'updating' => CurrencyUpdated::class,
    ];


    /**
     * Get currency history.
     */
    public function history()
    {
        return $this->hasMany(CurrenciesHistory::class, 'currency_id', 'id');
    }

}
