<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Administration\MedicalArea;
use App\Models\Administration\MedicalCenter;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctors';
    protected $fillable = [
        'name',
        'last_name',
        'document',
        'phone',
        'address',
        'medical_area_id',
        'active'
    ];

    public function medicalArea()
    {
        return $this->belongsTo(MedicalArea::class, 'medical_area_id');
    }

    public function medicalCenters()
    {
        return $this->belongsToMany(MedicalCenter::class, 'medical_center_doctors');
    }
}
