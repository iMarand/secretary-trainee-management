<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    use HasFactory;

    protected $table = 'trainees';
    protected $primaryKey = 'traineeId';

    protected $fillable = [
        'tFirstName',
        'tLastName',
        'tGender',
        'DOB',
        'ParentNationalId',
        'tradeCode',
        'Level',
    ];

    
    public function parent()
    {
        return $this->belongsTo(ParentModel::class, 'ParentNationalId', 'ParentNationalId');
    }

    
    public function trade()
    {
        return $this->belongsTo(Trade::class, 'tradeCode', 'tradeCode');
    }
}