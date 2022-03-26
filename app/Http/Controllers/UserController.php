<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at','desc')->paginate(20);
        return view('admin.user.index')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.register');
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
        return redirect("user")->with(['status' => 'el usuario ' . $request->input('names') .' ' . $request->input('surnames') . ' ha sido creado satisfactoriamente!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('dashboard.user.show')->with(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit')->with(['user'=>$user]);
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
                'email' => $request->input('email')
            ]);
        }


        //Obtenemos el objeto Profile de User
        $profile = Profile::find($user->id);

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

        return redirect("user")->with(['status' => 'el usuario ' . $user->profile->names . ' ' . $user->profile->surnames . ' ha sido actualizado satisfactoriamente!']);
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
        return redirect("user")->with(['status' => 'el usuario ha sido eliminado satisfactoriamente!']);
    }
}
