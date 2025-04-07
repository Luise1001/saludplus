<?php

namespace App\Models\Patient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient\Patient;
use App\Models\Administration\MedicalCenter;
use App\Models\Administration\MedicalArea;
use App\Models\Administration\Doctor;
use App\Models\Administration\MedicalSchedule;
use App\Models\User;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    protected $fillable = [
        'patient_id',
        'medical_center_id',
        'medical_area_id',
        'doctor_id',
        'reason',
        'date',
        'medical_schedule_id',
        'observation',
        'status',
        'user_id'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medicalCenter()
    {
        return $this->belongsTo(MedicalCenter::class);
    }

    public function medicalArea()
    {
        return $this->belongsTo(MedicalArea::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function medicalSchedule()
    {
        return $this->belongsTo(MedicalSchedule::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
