<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    use HasFactory;

    protected $table = 'parents';
    protected $primaryKey = 'ParentNationalId';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ParentNationalId',
        'pFirstName',
        'pLastName',
        'pGender',
        'PhoneNumber',
        'District',
    ];

    // Relationship with Trainees
    public function trainees()
    {
        return $this->hasMany(Trainee::class, 'ParentNationalId', 'ParentNationalId');
    }
}