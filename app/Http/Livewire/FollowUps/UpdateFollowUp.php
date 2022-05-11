<?php

namespace App\Http\Livewire\FollowUps;

use Livewire\Component;
use App\Models\FollowUp;
use Carbon\Carbon;

class UpdateFollowUp extends Component
{
    public $state = [];

    public $firstVisit;

    public $secondVisit;

    protected $validationAttributes = [
        "state.company_cod"        => 'Codigo empresa',
        "state.company_name"       => 'Nombre empresa',
        "state.company_address"    => 'Dirección empresa',
        "state.boss_name"          => 'Nombre jefe',
        "state.boss_phone"         => 'Telefono jefe',
        "state.boss_email"         => 'Correo jefe',
        "state.town"               => 'Ciudad',
        "state.dependency"         => 'Dependencia',
        "state.status"             => 'Estado',
        "firstVisit"               => 'Fecha primer visita',
        "state.first_observation"  => 'Observaciones primer visita',
        "secondVisit"              => 'Fecha segunda visita',
        "state.second_observation" => 'Observaviones segunda visita',
    ];

    public function mount(FollowUp $followUp)
    {
        $this->state = $followUp->withoutRelations()->toArray();

        $this->firstVisit  = $this->state['first_visit_date'] != '' ? 
                                      Carbon::parse($this->state['first_visit_date'])->format('Y-m-d') :
                                     '';

       $this->secondVisit = $this->state['second_visit_date'] != '' ? 
                                      Carbon::parse($this->state['second_visit_date'])->format('Y-m-d') :
                                     '';
    }

    protected function rules()
    {
        $sndVisit = Carbon::parse($this->firstVisit)->addDays(80);

        return [
            "state.company_cod"        => ['required'],
            "state.company_name"       => ['required'],
            "state.company_address"    => ['required'],
            "state.boss_name"          => ['required', 'regex:/^[^0-9]*$/i', 'max:100'],
            "state.boss_phone"         => ['nullable', 'regex:/^3+[0-9]*$/', 'max:10'],
            "state.boss_email"         => ['required', 'email'],
            "state.town"               => ['nullable', 'regex:/^[^0-9]*$/i', 'max:50'],
            "state.dependency"         => ['nullable', 'regex:/^[^0-9]*$/i', 'max:50'],
            "state.status"             => ['required', 'in:Completo,Incompleto'],
            "firstVisit"               => ['required_with:state.first_observation', 'date'],
            "state.first_observation"  => ['required_with:firstVisit', 'max:500'],
            
            "secondVisit"              => [
                'required_with:state.second_observation',
                'date',
                'after_or_equal:'.$sndVisit->toDateString()
            ],

            "state.second_observation" => ['required_with:secondVisit', 'max:500'],
        ];
    }

    public function updateFollowUpInformation()
    {
        $this->validate();

        try {
            $updateFollow = FollowUp::find($this->state['id']);

            $this->state['first_visit_date'] = $this->firstVisit;
            
            if ($this->secondVisit) {
                $this->state['second_visit_date'] = $this->secondVisit;                
            }

            $updateFollow->update($this->state);
            $this->emit('nice', 'Información actualizada correctamente');

        } catch (\Exception $e) {
            $this->emit('error', 'No se ha podido actualizar la información del seguimiento :[' . $e);
        }
    }
  
    public function render()
    {
        return view('livewire.follow-ups.update-follow-up');
    }
}
