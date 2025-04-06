<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Administration\MedicalCenter;
use App\Models\Administration\Doctor;

class MedicalArea extends Model
{
    use HasFactory;
    protected $table = 'medical_areas';
    protected $fillable = [
        'name',
        'description',
        'active'
    ];

    public function medicalCenters()
    {
        return $this->belongsToMany(MedicalCenter::class, 'medical_center_areas');
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'medical_area_id');
    }
}
