<?php

namespace App\Models\Patient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\State;
use App\Models\Municipality;
use App\Models\Parish;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';
    protected $fillable = [
        'user_id',
        'name',
        'last_name',
        'document',
        'birthday',
        'email',
        'phone',
        'age',
        'state_id',
        'municipality_id',
        'parish_id',
        'sector'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
}
