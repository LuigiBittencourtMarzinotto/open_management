<?php

namespace App\Http\Controllers;

use App\Models\EnderecoUser;
use App\Models\User;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('EnderecoUser')->get();
        return $users;
    }

    public function view()
    {
        return view("app.list-users");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('EnderecoUser')->find($id);
        return response()->json($user, 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->update([
            'name'=> $request->name,
            'email'=> $request->email,
            "user_tipo"=> $request->user_tipo,
        ]);
        $user->save();
        Session::put('nameUser', $request->name);
        Session::put('tipoUser', $request->user_tipo);
        $enderecosUser = EnderecoUser::where('usuario_id', $id)->get();

        foreach ($enderecosUser as $enderecoUser) {
            $enderecoUser->update([
                'cep' => $request->cep,
                'uf' => $request->uf,
                'cidade' => $request->cidade,
                'bairro' => $request->bairro,
                'logradouro' => $request->logradouro,
                'numero' => $request->numero,
            ]);
        }
    
        return response()->json($request, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showUser(String $codigoUser)
    {
        $id = Crypt::decrypt($codigoUser);
        return view("app.show-user", ['codigoUser'=> $id]);
    }
    
}
