<?php

namespace App\Services\Locations;

use App\Models\State;
use App\Models\Municipality;
use App\Models\Parish;
use App\Services\Locations\Contracts\LocationServiceInterface;
use Illuminate\Support\Collection;

class LocationService implements LocationServiceInterface
{
    public function getStates(): Collection
    {
        return State::orderBy('name')->get();
    }

    public function getMunicipalitiesByState(int $stateId): Collection
    {
        return Municipality::where('state_id', $stateId)->orderBy('name')->get();
    }

    public function getParishesByMunicipality(int $municipalityId): Collection
    {
        return Parish::where('municipality_id', $municipalityId)->orderBy('name')->get();
    }
}
