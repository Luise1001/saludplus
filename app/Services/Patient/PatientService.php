<?php

namespace App\Services\Patient;

use App\Models\Patient\Patient;
use App\Services\Patient\Contracts\PatientServiceInterface;

class PatientService implements PatientServiceInterface
{
    public function findById(int $id): ?Patient
    {
        return Patient::find($id);
    }

    public function findByDocument(string $document): ?Patient
    {
        return Patient::where('document', $document)->first();
    }

    public function create(array $data): Patient
    {
        return Patient::create($data);
    }
}
