<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Municipality;
use App\Models\Administration\MedicalCenter;

class Parish extends Model
{
    use HasFactory;

    protected $table = 'parishes';
    protected $fillable = [
        'municipality_id',
        'name',
    ];

    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'municipality_id');
    }

    public function medicalCenters()
    {
        return $this->hasMany(MedicalCenter::class, 'parish_id');
    }
}
