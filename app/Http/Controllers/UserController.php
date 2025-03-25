<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index() {
        $users = User::where('id', '!=', Auth::id())->with('roles')->get();
        return view('usuarios.index', compact('users'));
    }
    public function create() {
        return view('usuarios.create');
    }

    public function show($id) {
        $usuario = User::find(Auth::id());
        if ($usuario->id == $id) {
            return redirect()->route('usuarios.index')->with('error', 'No tienes permisos para editar este usuario.');
        }
        $user = User::findOrFail($id);
        return view('usuarios.show', compact('user'));
    }

    public function store(Request $request) {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', 'string', 'exists:roles,name']
        ]);

        if($validate->fails()) {
            return response()->json([
                'errors' => $validate->errors()
            ], 422);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        // Asignar el rol
        $user->assignRole($request->role);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito.');
    }

    public function edit($id) {
        $usu = User::find(Auth::id());
        // Verificar si el ID del usuario autenticado es igual al que intenta editar
        if ($usu && $usu->id == $id) {
            return redirect()->route('usuarios.index');
        }

        $user = User::findOrFail($id);
        $roles = Role::all(); // Obtener todos los roles
        $userRole = $user->roles->first()->name ?? ''; // Obtener el rol asignado al usuario

        return view('usuarios.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        // Buscar el usuario
        $user = User::findOrFail($id);

        // Validación de los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id . '|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Si la validación falla, redirige con errores
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Actualizar los datos del usuario
        $user->name = $request->name;
        $user->email = $request->email;

        // Si se proporciona una nueva contraseña, se actualiza
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Actualizar el rol del usuario
        $user->syncRoles([$request->role]);

        // Redirige con un mensaje de éxito
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado con éxito.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Esto no eliminará el registro, solo lo marcará como eliminado

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}