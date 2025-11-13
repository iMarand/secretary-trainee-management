<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected $table = 'trades';
    protected $primaryKey = 'tradeCode';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'tradeCode',
        'TradeName',
    ];

    // Relationship with Trainees
    public function trainees()
    {
        return $this->hasMany(Trainee::class, 'tradeCode', 'tradeCode');
    }
}
