<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Municipality;
use App\Models\Administration\MedicalCenter;

class State extends Model
{
    use HasFactory;

    protected $table = 'states';
    protected $fillable = [
        'name',
        'capital',
    ];

    public function municipalities()
    {
        return $this->hasMany(Municipality::class, 'state_id');
    }

    public function medicalCenters()
    {
        return $this->hasMany(MedicalCenter::class, 'state_id');
    }
}
