<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Administration\MedicalCenter;
use App\Models\Administration\MedicalArea;

class MedicalSchedule extends Model
{
    use HasFactory;
    
    protected $table = 'medical_schedules';
    protected $fillable = [
        'medical_center_id',
        'medical_area_id',
        'day',
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
}
