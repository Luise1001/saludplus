<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Administration\MedicalCenter;
use App\Models\Administration\MedicalArea;
use App\Models\Patient\Reservation;

class MedicalSchedule extends Model
{
    use HasFactory;
    
    protected $table = 'medical_schedules';
    protected $casts = [
        'days' => 'array',
        'hour' => 'datetime:H:i',
        'active' => 'boolean',
    ];
    protected $fillable = [
        'medical_center_id',
        'medical_area_id',
        'days',
        'hour',
        'slots',
        'active'
    ];

    public function medicalCenter()
    {
        return $this->belongsTo(MedicalCenter::class);
    }

    public function medicalArea()
    {
        return $this->belongsTo(MedicalArea::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
