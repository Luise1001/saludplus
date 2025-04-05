<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;
use App\Models\Parish;
use App\Models\Administration\MedicalCenter;

class Municipality extends Model
{
    use HasFactory;

    protected $table = 'municipalities';
    protected $fillable = [
        'state_id',
        'name',
        'capital',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    public function parishes()
    {
        return $this->hasMany(Parish::class, 'municipality_id');
    }

    public function medicalCenters()
    {
        return $this->hasMany(MedicalCenter::class, 'municipality_id');
    }
}
