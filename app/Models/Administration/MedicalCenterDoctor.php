<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Administration\MedicalCenter;
use App\Models\Administration\Doctor;

class MedicalCenterDoctor extends Model
{
    use HasFactory;
    protected $table = 'medical_center_doctors';
    protected $fillable = [
        'medical_center_id',
        'doctor_id'
    ];

    public function medicalCenter()
    {
        return $this->belongsTo(MedicalCenter::class, 'medical_center_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
