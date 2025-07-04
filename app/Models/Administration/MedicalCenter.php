<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;
use App\Models\Municipality;
use App\Models\Parish;
use App\Models\Administration\MedicalArea;
use App\Models\Administration\Doctor;

class MedicalCenter extends Model
{
    use HasFactory;
    protected $table = 'medical_centers';
    protected $fillable = [
        'name',
        'short_name',
        'document',
        'active',
        'state_id',
        'municipality_id',
        'parish_id'
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }   

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function parish()
    {
        return $this->belongsTo(Parish::class);
    }

    public function medicalAreas()
    {
        return $this->belongsToMany(MedicalArea::class, 'medical_center_areas');
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'medical_center_doctors');
    }

}
