<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Administration\MedicalCenter;
use App\Models\User;

class MedicalCenterStaff extends Model
{
    use HasFactory;
    protected $table = 'medical_center_staff';
    protected $fillable = [
        'medical_center_id',
        'user_id',
    ];

    public function medicalCenter()
    {
        return $this->belongsTo(MedicalCenter::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
