<?php

namespace App\Livewire\App\Patients;

use Livewire\Component;
use App\Services\Locations\Contracts\LocationServiceInterface;

class PatientLocationSelector extends Component
{
    public $document;

    public $state_id;
    public $municipality_id;
    public $parish_id;

    public $states = [];
    public $municipalities = [];
    public $parishes = [];

    protected $locationService;

    public function boot(LocationServiceInterface $locationService)
    {
        $this->locationService = $locationService;
    }

    public function mount($document, $state_id = null, $municipality_id = null, $parish_id = null)
    {
        $this->document = $document;
        $this->states = $this->locationService->getStates();

        $this->state_id = $state_id;
        $this->municipality_id = $municipality_id;
        $this->parish_id = $parish_id;

        if ($this->state_id) {
            $this->state($this->state_id);
        }

        if ($this->municipality_id) {
            $this->municipality();
        }
    }


    public function state($state_id)
    {
        $this->state_id = $state_id;
        $this->municipalities = $this->locationService->getMunicipalitiesByState((int) $this->state_id);
        $this->municipality_id = null;
        $this->parishes = [];
        $this->parish_id = null;
    }

    public function municipality($municipality_id)
    {
        $this->municipality_id = $municipality_id;
        $this->parishes = $this->locationService->getParishesByMunicipality((int) $this->municipality_id);
        $this->parish_id = null;
    }

    public function render()
    {
        return view('livewire.app.patients.patient-location-selector');
    }
}
