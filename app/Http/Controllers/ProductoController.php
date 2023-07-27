<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function seleccionarTipo()
    {
        return view('home.discountKitchen.seleccionar_tipo_producto');
    }

    public function seleccionarSubtipo(Request $request)
    {
        $tipo = $request->input('tipo');
        $subtipos = [];

        if ($tipo === 'cocina') {
            $subtipos = ['gas', 'electrica'];
        } elseif ($tipo === 'anafe') {
            $subtipos = ['2_hornallas', '4_hornallas'];
        } elseif ($tipo === 'calefactor') {
            $subtipos = ['tiro_balanceado', 'camara_abierta'];
        }

        return view('home.discountKitchen.seleccionar_subtipo_producto', ['tipo' => $tipo, 'subtipos' => $subtipos]);
    }

    public function seleccionarOpciones(Request $request)
    {
        $tipo = $request->input('tipo');
        $subtipo = $request->input('subtipo');

        

        return "Has seleccionado un $tipo de $subtipo";
    }
}
