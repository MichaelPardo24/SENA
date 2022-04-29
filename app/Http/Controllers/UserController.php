<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Actions\Fortify\CreateNewUser;
use Spatie\Permission\Models\Role;
use App\Models\Ficha;


class UserController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:users_index')->only('index');
        $this->middleware('can:users_create')->only('create', 'store');
        $this->middleware('can:users_edit')->only('edit', 'update');
        $this->middleware('can:users_destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('auth.register')->with(['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestArrayConvert = $request->toArray();
        $createNewUser = new CreateNewUser;
        $createNewUser->create($requestArrayConvert);
        return redirect("user")->with(['success' => 'el usuario ' . $request->input('names') .' ' . $request->input('surnames') . ' ha sido creado satisfactoriamente!']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->user = $user;

        if ($user->hasrole('Aprendiz')){
            $apprenticeFicha = Ficha::withTrashed()
            ->whereHas('users.roles', function ($q) {
                $q->where('roles.name', 'Aprendiz');
                $q->where('users.id', $this->user->id);
            })
            ->orderBy('id', 'desc')
            ->take(1)
            ->get();
            if (!is_null($apprenticeFicha) && count($apprenticeFicha) > 0){
                foreach ($apprenticeFicha as $ficha) {
                    $apprenticeFicha = $ficha;
                }
                $user['status'] = $user->fichas()
                    ->where('ficha_id', $apprenticeFicha->id)
                    ->first()
                    ->pivot->status;
            }
        
        } else{
            $apprenticeFicha = null;
        }
        
        //Obtener las fichas relacionadas al instructor Tecnico
        if ($user->hasrole('Instructor Tecnico')){
            $tecnicoFichas = Ficha::whereHas('users.roles', function ($q) {
                $q->where('roles.name', 'Instructor Tecnico');
                $q->where('users.id', $this->user->id);
            })
            ->get();
        } else{
            $tecnicoFichas = null;
        }

        //Obtener las fichas relacionadas al instructor Seguimiento
        if ($user->hasrole('Instructor Seguimiento')){
            $seguimientoFichas = Ficha::whereHas('users.roles', function ($q) {
                $q->where('roles.name', 'Instructor Seguimiento');
                $q->where('users.id', $this->user->id);
            })
            ->get();
        } else{
            $seguimientoFichas = null;
        }

        //Verificar si el usuario autentificado puede obtener datos de todos los usuarios
        if (auth()->user()->hasrole('Manager|Coordinador')) {
            $roles = Role::all();
            return view('admin.user.edit')->with(['user'=>$user, 'roles'=>$roles, 'tecnicoFichas' => $tecnicoFichas, 'seguimientoFichas' => $seguimientoFichas, 'apprenticeFicha' => $apprenticeFicha]);
        } else {
            if ($user->hasrole('Manager|Coordinador|Instructor Tecnico|Instructor Seguimiento')){
                return redirect("user")->with(['error' => 'No puedes modificar este usuario']);
            } else {
                $roles = Role::all();
                return view('admin.user.edit')->with(['user'=>$user, 'roles'=>$roles, 'tecnicoFichas' => $tecnicoFichas, 'seguimientoFichas' => $seguimientoFichas, 'apprenticeFicha' => $apprenticeFicha]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //Verifica si el espacio 'password' esta lleno, si es asi actualiza lo ingresado, si no
        //actualiza todo lo ingresado menos la contraseña
        if ($request->input('password')){
            $user->update([
                'document' => $request->input('document'),
                'password' => Hash::make($request->input('password')),
                'email' => $request->input('email')
            ]);
        } else {
            $user->update([
                'document' => $request->input('document'),
                'email' => $request->input('email'),
            ]);
        }

        //Actualizamos el objeto Profile
        $user->profile->update([
            'document' => $request->input('document'),
            'document_type' => $request->input('document_type'),
            'names' => $request->input('names'),
            'surnames' => $request->input('surnames'),
            'phone' => $request->input('phone'),
            'direction' => $request->input('direction'),
            'birth_at' => $request->input('birth_at'),
        ]);

        //añadimos el rol
        $user->roles()->sync($request->input('rol'));

        return redirect("user")->with(['success' => 'el usuario ' . $user->profile->names . ' ' . $user->profile->surnames . ' ha sido actualizado satisfactoriamente!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect("user")->with(['success' => 'el usuario ' . $user->names . ' ' . $user->surnames . 'ha sido eliminado satisfactoriamente!']);
    }
}
