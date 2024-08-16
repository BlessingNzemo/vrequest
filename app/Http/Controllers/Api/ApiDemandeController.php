<?php

namespace App\Http\Controllers\Api;

use App\Models\Demande;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DemandeResource;
use Illuminate\Support\Facades\Session;

class ApiDemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(DemandeResource::collection($demandes = Demande::where('is_validated', 1)->where('status', '1')->orderByDesc('created_at')->get()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            "date" => "required|date_format:Y-m-d",
            "motif" => "required|max:60|min:3",
            "date_deplacement" => "required|date_format:Y-m-d H:i",
            "lieu_depart" => "required|string",
            "destination" => "required|string",
            "nbre_passagers" => "required|integer",
            "longitude_depart" => "required",
            "latitude_depart" => "required",
            "longitude_destination" => "required",
            "latitude_destination" => "required"

        ]);
        $demande = Demande::create($request->all());

        return response()->json([
            'demande' => $demande
        ], 200);


    }
    public function cancel(Request $request)
    {
        $id = $request->id;
        $demande = Demande::find($id);
         
        if ($demande->is_validated == 0) {
            $demande->delete();
            

        return response()->json(['message' => 'Demande annulée avec succès.']);
            
        }
        return response()->json(['message' =>"impossible d'annuler la demande car elle est déjà tritée"]);
       
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        return response()->json(Demande::find($id));



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function userDemande(Request $request)
    {

        $id = $request->id;

        $demande_encours = Demande::where('user_id',$id)->where('status',0)->count();
        $demandes_encours = Demande::where('user_id',$id)->where('status',0)->get();
        $demande_traite = Demande::where('user_id',$id)->where('status',1)->count();
        $demande_total = Demande::where('user_id',$id)->count();
        $demande_non_traite = Demande::where('is_validated',1)->where('status',0)->count();
         
        $vehicule_nondispo = Vehicule::where('disponibilite',1)->count();
        $vehicule_disponible = Vehicule::where('disponibilite',0)->count();
        $vehicule_total = Vehicule::all()->count();

        $traites = Demande::where('status',0)->count();
       
        $demande_tab = [
            "demande_encours" => $demande_encours,
            "demande_traite" =>$demande_traite,
            "demande_total" =>$demande_total,
            "demande_non_traite"=>$demande_non_traite,

            "Vehicule_nondispo" => $vehicule_nondispo,
            "Vehicule_disponible" => $vehicule_disponible,
            "Vehicule_total" => $vehicule_total,
            "demandes_encours" => $demandes_encours,
            'charroi_traite'=> $traites
        ];

        return response()->json($demande_tab);
    }

    public function lastDemande(Request $request){
        return response()->json(Demande::where('user_id',$request->id)->latest()->take(2)->get());

  
    }

    public function getdemande(Request $request)
    {

        return response()->json(Demande::where('user_id', $request->id)->get());
    }
    public function getAllDemande(Request $request){
        $id = $request->id;
        $demandes = Demande::where('user_id',$id)->get();
        return DemandeResource::collection($demandes);
    }
    
    public function getDemandeTraite(Request $request){
        $id = $request->id;
        $demandes = Demande::where('user_id',$id)->where('status',1)->get();
        return DemandeResource::collection($demandes);
    }


}
