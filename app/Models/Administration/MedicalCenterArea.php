<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Administration\MedicalCenter;
use App\Models\Administration\MedicalArea;

class MedicalCenterArea extends Model
{
    use HasFactory;

    protected $table = 'medical_center_areas';
    protected $fillable = [
        'medical_center_id',
        'medical_area_id',
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
