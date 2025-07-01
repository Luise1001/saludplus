<?php

namespace App\Services\Locations\Contracts;

use Illuminate\Support\Collection;

interface LocationServiceInterface
{
    public function getStates(): Collection;

    public function getMunicipalitiesByState(int $stateId): Collection;

    public function getParishesByMunicipality(int $municipalityId): Collection;
}
