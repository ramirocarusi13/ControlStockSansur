<?php


namespace App\Http\Controllers;

use App\Models\materials;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class materialsController extends Controller
{

    public function buscarMateriales(Request $request)
    {
        $query = $request->input('q');

        if ($query) {
            $materials = materials::where('product_code', 'LIKE', "%$query%")
                ->orWhere('name', 'LIKE', "%$query%")
                ->paginate(8);
        } else {
            $materials = null;
        }

        return view('home.material.tabla_material', compact('materials'));
    }

    public function mostrarVistaEliminar()
    {
        return view('home.material.formulario_eliminar_material');
    }
    public function eliminarMaterial(Request $request)
    {
        $identifier = $request->input('identifier');
        $type = $request->input('type');

        if ($type === 'product_code') {
            $material = materials::where('product_code', $identifier)->first();
        } elseif ($type === 'name') {
            $material = materials::where('name', $identifier)->first();
        }

        if (!$material) {
            // Si no se encuentra el material, puedes retornar una redirección o un mensaje de error.
            return redirect()->back()->with('error', 'El material no existe.');
        }

        $material->delete();

        session()->flash('notification', "Material eliminado correctamente.");
    }




    public function create(Request $request)
    {
        try {
            // Valida los datos del formulario antes de guardarlos en la base de datos (opcional)

            $material = new materials;
            $material->product_code = $request->input('product_code');
            $material->name = $request->input('name');
            $material->stock = $request->input('stock');

            $material->save();


            session()->flash('success', 'Material agregado exitosamente');


            return response()->json(['success' => true, 'message' => 'Material agregado exitosamente']);
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function addStock(Request $request, $id)
    {
        try {
            // Valida los datos del formulario antes de agregar el stock en la base de datos (opcional)
            $material = materials::find($id);
            if (!$material) {
                return response()->json(['success' => false, 'message' => 'Material no encontrado']);
            }

            $stockToAdd = $request->input('stock_to_add');
            if (!is_numeric($stockToAdd) || $stockToAdd <= 0) {
                return response()->json(['success' => false, 'message' => 'La cantidad a agregar debe ser un número positivo']);
            }

            // Agrega el stock al material
            $material->stock += $stockToAdd;
            $material->save();

            // Enviar una respuesta JSON en caso de éxito
            return response()->json(['success' => true, 'message' => 'Stock agregado exitosamente']);
        } catch (\Exception $e) {
            // Enviar una respuesta JSON en caso de error
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }







    public function list()
    {
        $materials = materials::where('active', true)
            ->orderBy('name', 'asc')
            ->paginate(8);

        return view('home.material.tabla_material')
            ->with(['materials' => $materials]);
    }
    public function deactivateMaterial($id)
    {
        try {
            $material = materials::find($id);

            if ($material) {
                $material->active = 0;
                $material->save();

                return response()->json(['success' => 1]);
            } else {
                return response()->json(['success' => 0, 'message' => 'Material not found']);
            }
        } catch (Exception $e) {
            return response()->json(['success' => 0, 'message' => $e->getMessage()]);
        }
    }
}
