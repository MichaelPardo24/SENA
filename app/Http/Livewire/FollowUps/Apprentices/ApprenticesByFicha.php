<?php

namespace App\Http\Livewire\FollowUps\Apprentices;

use App\Models\Ficha;
use App\Models\FollowUp;
use Livewire\Component;

class ApprenticesByFicha extends Component
{
    /**
     * Ficha xd
     * 
     * @var \App\Models\Ficha
     */
    public $ficha;

    /**
     * Representa los tipos de etapa productiva
     * que se pueden seleccionar.
     * 
     * @var Illuminate\Database\Eloquent\Collection
     */
    public $types;

    /**
     * Filtros que seran aplicados a la tabla.
     * 
     * @var Array
     * @property String search      Filtro para nombres, documento y correo
     * @property String onlyFollow  Filtro para estado de alumnos 
    */
    public $filters = ['search' => '', 'onlyFollow' => false];

    /**
     * Determina si el modal de creacion de 
     * seguimiento debe mostrarse o no.
     */
    public $openModal = false;

    /**
     * El estado del componente
     */
    public $state = [];

    /**
     * Index usado para obtener un aprendiz de la 
     * coleccion. 
     */
    public $n = 0;

    /**
     * Nombres custom para la validacion del metodo
     * createFollowup
     * @var Array
     */
    protected $validationAttributes = [
        'state.apprentice_id'   => 'Importante',
        'state.type_id'         => 'Tipo de productiva',
        'state.company_cod'     => 'codigo de empresa',
        'state.company_name'    => 'nombre de empresa',
        'state.company_address' => 'direccion de empresa',
        'state.boss_name'       => 'nombre del jefe',
        'state.boss_phone'      => 'telefono del jefe',
        'state.boss_email'      => 'correo del jefe',
    ];

    protected function rules()
    {
        return [
            'state.apprentice_id'   => ['required'],
            'state.type_id'         => ['required', 'exists:production_stage_types,id'],
            'state.company_cod'     => ['required'],
            'state.company_name'    => ['required'],
            'state.company_address' => ['required'],
            'state.boss_name'       => ['required', 'regex:/^[^0-9]*$/i', 'max:100'],
            'state.boss_phone'      => ['required', 'regex:/^3+[0-9]*$/', 'max:10'],
            'state.boss_email'      => ['required', 'email'],
        ];
    }

    public function mount(Ficha $ficha)
    {
        $this->ficha = $ficha;

        $this->state = [
            'apprentice_id'   => '',
            'company_cod'     => '',
            'company_name'    => '',
            'company_address' => '',
            'boss_name'       => '',
            'boss_phone'      => '',
            'boss_email'      => '',
        ];

        $this->types = \App\Models\ProductionStageType::all();
    }

    /**
     * Cuando se actualiza openModal, es necesario hacer
     * 'reset' al state y a la validaci??n.
     */
    public function updatedOpenModal()
    {
        $this->reset('state');
        $this->resetValidation();
    }

    /**
     * Establece variables necesarias para evitar errores
     * al abrir el modal.
     * 
     * @param Int $index Representa el indice del aprendiz en la coleccion
     * @param Int $apprentice_id Representa el id del aprendiz seleccionado
     */
    public function setModal($index, $apprentice_id)
    {
        $this->n = $index;
        $this->state['apprentice_id'] = $apprentice_id;
        $this->openModal = true;
    }

    /**
     * Crea un seguimiento. Si ocurre algun error, se informa al usuario
     * por medio de una toast.
     * 
     * @return Void
     */
    public function createFollowUp()
    {
        $this->validate();
        try {
            FollowUp::create(
                array_merge($this->state, [
                    'start_date' => now(),
                    'ficha_id' => $this->ficha->id,
                    'instructor_id' => auth()->id(),
                ])
            );
            $this->openModal = false;
            $this->emit('nice', 'Se ha generado el seguimiento correctamente!');

        } catch (\Exception $e) {
            $this->emit('error', 'Ha ocurrido un error al generar el seguimiento!');
        }
    }

    public function render()
    {
        $method = $this->filters['onlyFollow'] ? 'whereHas' : 'whereDoesntHave';

        $apprentices = $this->ficha->users()->role('Aprendiz')
            ->with('profile')
            ->$method('apFollowUps', function ($q){ 
                $q->where('ficha_id', $this->ficha->id);
            })
            ->where(function ($q) {
                $q->where('document', 'LIKE', '%'. $this->filters['search'] .'%')
                ->orWhere('email', 'LIKE', '%'. $this->filters['search'] .'%')
                ->orWhereRelation('profile', 'names', 'LIKE', '%'. $this->filters['search'] .'%')
                ->orWhereRelation('profile', 'surnames', 'LIKE', '%'. $this->filters['search'] .'%');
            })
            ->wherePivot('status', 'Preparado')
            ->get();

        return view('livewire.follow-ups.apprentices.apprentices-by-ficha', 
                [
                    'apprentices' => $apprentices->sortBy('profile.names')
                ]);
    }
}
