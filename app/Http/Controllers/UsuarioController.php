<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UsuarioController extends Controller
{
    public function index(){
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create(){
        return view('usuarios.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Algo salió mal, intenta de nuevo.');
        }
    }

    public function edit($id){
        $usuario = User::find($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['string', 'min:8'],
        ]);

        try {
            $user = User::find($id);
           
            if ($user) {
                if(!empty($request->password)){
                    $user->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => $request->password ? Hash::make($request->password) : $user->password,
                    ]);
                }else{
                    $user->update([
                        'name' => $request->name,
                        'email' => $request->email
                    ]);
                }
                
                return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
            } else {
                return redirect()->back()->with('error', 'Usuario no encontrado.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Algo salió mal, intenta de nuevo.');
        }
    }


    public function destroy($id){
        try {
            User::destroy($id);
            return redirect()->route('usuarios.index')->with('success', 'Usuario borrado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Algo salió mal, intenta de nuevo.');
        }
    }
}
