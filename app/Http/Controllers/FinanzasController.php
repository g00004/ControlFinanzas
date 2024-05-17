<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Salida;
use Carbon\Carbon;

class FinanzasController extends Controller
{
    public function craer_entradas(){
        return view('entradas.create');
    }

    public function guardar_entrada(Request $request){
        try{
            $entrada = new Entrada();
            $entrada->tipo_entrada = $request->tipo_entrada;
            $entrada->monto = $request->monto;
            $entrada->fecha = $request->fecha;
            $entrada->user_id = Auth::user()->id;
            //mover imagen a la capeta facturas
            $filename = time().'.'.$request->file('factura')->getClientOriginalExtension();
            $request->file('factura')->move(public_path('/facturas/'), $filename);
            $entrada->factura = '/facturas/'.$filename;
            $entrada->save();

            return array('tipo'=>'success','mensaje'=>'Entrada Guardada');
        }catch(\Exception $e){
            // $e->getMessage()
            return array('tipo'=>'error','mensaje'=>'Algo Salio mal intento más tarde');
        }
    }

    
    public function all_entradas(){
        $entradas = Entrada::where('user_id',Auth::user()->id)->get();
        return view('entradas.index',compact('entradas'));
    }
   

    public function entrada_destroy(Request $request){
        Entrada::destroy($request->id);
        return array('tipo'=>'success','mensaje'=>'Entrada Eliminada');
    }

    // Metodos modulo salidas

    public function craer_salidas(){
        return view('salidas.create');
    }

    public function guardar_salida(Request $request){
        try{
            $salida = new Salida();
            $salida->tipo_salida = $request->tipo_salida;
            $salida->monto = $request->monto;
            $salida->fecha = $request->fecha;
            $salida->user_id = Auth::user()->id;
            //mover imagen a la capeta facturas
            $filename = time().'.'.$request->file('factura')->getClientOriginalExtension();
            $request->file('factura')->move(public_path('/facturas/'), $filename);
            $salida->factura = '/facturas/'.$filename;
            $salida->save();

            return array('tipo'=>'success','mensaje'=>'Salida Guardada');
        }catch(\Exception $e){
            // $e->getMessage()
            return array('tipo'=>'error','mensaje'=>'Algo Salio mal intento más tarde');
        }
    }

    public function all_salidas(){
        $salidas = Salida::where('user_id',Auth::user()->id)->get();
        return view('salidas.index',compact('salidas'));
    }
   
    public function salida_destroy(Request $request){
        Salida::destroy($request->id);
        return array('tipo'=>'success','mensaje'=>'Salida Eliminada');
    }

    public function balance(){
        $inicioMes = Carbon::now()->startOfMonth()->toDateString();
        $finMes = Carbon::now()->endOfMonth()->toDateString();

        $entradas = Entrada::where('user_id',Auth::user()->id)->whereBetween('fecha', array($inicioMes,$finMes))->get();
        $salidas = Salida::where('user_id',Auth::user()->id)->whereBetween('fecha', array($inicioMes,$finMes))->get();
        
        $totalEntradas = count($entradas);
        $totalSalidas = count($salidas);

        return view('balance.index',compact('inicioMes','finMes','entradas','salidas','totalEntradas','totalSalidas'));
    }
}