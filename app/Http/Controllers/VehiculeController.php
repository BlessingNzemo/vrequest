<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicules=Vehicule::all();
        $marques=[];
        foreach ($vehicules as $vehicule) {
            $marques[] = $vehicule->marque;
        }
// dd($marques);
        return view("vehicules.index",compact('vehicules', 'marques'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //  return redirect()->route('vehicules.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    $vehicule= Vehicule::create([
        'plaque'=>$request->plaque,
        'marque'=>$request->marque,
        'capacite'=>$request->capacite,
        'disponible'=>1,
        $request->session()->flash('success', 'Le véhicule a été enregistré avec succès.'),
    ]);  
        return redirect()->route('vehicules.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicule $vehicule)
    {
        //
        dd($vehicule);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicule $vehicule)
    {   
       
         return view('vehicules.edit',compact('vehicule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicule $vehicule)
    {
        
    $vehicule->plaque = $request->input('plaque');
    $vehicule->marque = $request->input('marque');
    $vehicule->capacite = $request->input('capacite');

    $vehicule->update();
    return redirect()->route('vehicules.index')->with('success', 'Véhicule mis à jour avec succès.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicule $vehicule)
    {
        $vehicule->delete();
        return back()->with("success","suppression reussie");
    }

    public function search(Request $request)
{
    $searchQuery = $request->input('search');
    // dd(request()->input('search'));

    $vehicules = Vehicule::query();

    if ($searchQuery) {
        $vehicules->where('capacite', 'LIKE', '%' . $searchQuery . '%');
        // dd($vehicules);
    }

    $data['result'] = $vehicules->paginate(10);

    return view('/vehicules/show', $data);
}
    public function vehiculeDisponibilite($id){


        $vehicule = Vehicule::find($id);

        if($vehicule->disponibilite == 1){
        $vehicule->disponibilite = 0;
        $vehicule->update();
        return back();
    }
    else if($vehicule->disponibilite == 0){
        $vehicule->disponibilite = 1;
        $vehicule->update();
        return back();
    }
}
}
