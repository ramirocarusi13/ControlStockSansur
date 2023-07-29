<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class usersController extends Controller
{
    public function view()
    {
        return view('users.users');
    }
    public function buscarUsers(Request $request)
    {
        $query = $request->input('q');

        if ($query) {
            $users = User::where('first_name', 'LIKE', "%$query%")
                ->orWhere('last_name', 'LIKE', "%$query%")
                ->orWhere('email', 'LIKE', "%$query%")
                ->paginate(8);
        } else {
            // Si no se ingresa un término de búsqueda, simplemente obtén todos los usuarios activos.
            $users = User::where('active', true)
                ->orderBy('first_name', 'asc')
                ->paginate(8);
        }

        return view('users.usersList', compact('users'));
    }
    public function list()
    {
        $users = User::where('active', true)
            ->orderBy('first_name', 'asc')
            ->paginate(8);

        return view('users.usersList', compact('users'));
    }
    /* public function desactivarUsuario($id)
    {
        // Buscar el usuario por su ID
        $user = User::find($id);

        if ($user) {
            // Cambiar el estado del usuario a inactivo
            $user->active = false;
            $user->save();
        }

        return redirect()->route('users')->with('success', 'Usuario desactivado exitosamente');
    } */
    public function desactivarUsuario($id)
    {
        // Buscar el usuario por su ID
        $user = User::find($id);

        if ($user) {
            // Cambiar el estado del usuario a inactivo
            $user->active = false;
            $user->save();

            // Almacenar un mensaje de éxito en la sesión flash
            Session()::flash('success', 'Usuario desactivado exitosamente');
        }

        return redirect()->route('users.usersList');
    }
    public function getUserData($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json(['success' => true, 'user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);

        $user->dni = $request->input('dni');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->phone_number = $request->input('phone_number');
        $user->email = $request->input('email');

        $user->save();

        return to_route('users.details', ['id' => $id])->with(['user' => $user, 'status' => 'Usuario modificado correctamente']);
    }
    public function details($id)
    {

        $user = User::find($id);

        $productive_units = $user->productive_units;

        return view('users.details')
            ->with(['user' => $user], ['status' => null])
            ->with(['productive_units' => $productive_units]);
    }
}
