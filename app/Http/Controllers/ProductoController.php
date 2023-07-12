<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductoCollection;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return new ProductoCollection(Producto::orderBy('id', 'DESC')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Producto $producto)
    {
        //
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->imagen = "image_00";
        $producto->disponible = $request->disponible;
        $producto->categoria_id = $request->categoria_id;
        $producto->stock = $request->stock;
        $producto->save();

        return [
            'producto' => $producto
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
        $producto->nombre = $request->nombre ?? $producto->nombre;
        $producto->precio = $request->precio ?? $producto->precio;
        $producto->disponible = $request->disponible ?? $producto->disponible;
        $producto->categoria_id = $request->categoria_id ?? $producto->categoria_id;

        if ($request->has('stock')) {
            $producto->stock = $request->stock;
        } else {
            return response()->json(['error' => '"Stock" es obligatorio.'], 400);
        }
        
        $producto->save();

        return [
            'producto' => $producto
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
