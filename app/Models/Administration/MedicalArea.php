<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalArea extends Model
{
    use HasFactory;
    protected $table = 'medical_areas';
    protected $fillable = [
        'name',
        'description',
        'active'
    ];
}
