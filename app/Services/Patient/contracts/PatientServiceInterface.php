<?php 

namespace App\Services\Patient\Contracts;

use App\Models\Patient\Patient;

interface PatientServiceInterface
{
    public function findById(int $id): ?Patient;
    
    public function findByDocument(string $document): ?Patient;
    
    public function create(array $data): Patient;
}