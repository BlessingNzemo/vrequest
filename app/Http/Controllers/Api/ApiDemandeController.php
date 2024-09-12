<?php

namespace App\Http\Controllers\Api;

use App\Models\Demande;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DemandeResource;
use App\Models\Passager;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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
            "date_deplacement" => "required|date_format:Y-m-d H:i|after:today",
            "lieu_depart" => "required|string",
            "destination" => "required|string",
            "nbre_passagers" => "required|integer",
            "longitude_depart" => "required",
            "latitude_depart" => "required",
            "longitude_destination" => "required",
            "latitude_destination" => "required",
            "passagers" => "required",

        ]);
        $url = Str::random(16);
        $demande = [
            "motif" => $request->motif,
            "ticket" => $request->ticket,
            "date_deplacement" => $request->date_deplacement,
            "date" => $request->date,
            "nbre_passagers" => $request->nbre_passagers,
            "user_id" => $request->user_id,
            "manager_id" => $request->manager_id,
            "lieu_depart" => $request->lieu_depart,
            "destination" => $request->destination,
            "latitude_depart" => $request->latitude_depart,
            "longitude_depart" => $request->longitude_depart,
            "latitude_destination" => $request->latitude_destination,
            "longitude_destination" => $request->longitude_destination,
            "Url" => $url
        ];
        $demande = Demande::create($demande);
        $passagers = $request->passagers;

        if (is_array($passagers)) {
            foreach ($passagers as $passager) {
                Passager::create([
                    'user_id' => $passager['id'] ?? 0,
                    'demande_id'=>$demande->id,

                ]);
            }
        }

        return response()->json([
            'demande' => $passagers
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
        return response()->json(['message' => "impossible d'annuler la demande car elle est déjà tritée"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $demande = Demande::with("user")->findOrFail($id);
        return response()->json($demande);
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

        $demande_encours = Demande::where('user_id', $id)->where('status', '0')->count();
        $demandes_encours = Demande::where('user_id', $id)->where('status', '0')->get();
        $demande_traite = Demande::where('user_id', $id)->where('status', '1')->count();
        $demande_total = Demande::where('user_id', $id)->count();
        $demande_non_traite = Demande::where('is_validated', 1)->where('status', '0')->count();

        $vehicule_nondispo = Vehicule::where('disponibilite', 1)->count();
        $vehicule_disponible = Vehicule::where('disponibilite', 0)->count();
        $vehicule_total = Vehicule::all()->count();

        $traites = Demande::where('status', 0)->count();

        $demande_tab = [
            "demande_encours" => $demande_encours,
            "demande_traite" => $demande_traite,
            "demande_total" => $demande_total,
            "demande_non_traite" => $demande_non_traite,

            "Vehicule_nondispo" => $vehicule_nondispo,
            "Vehicule_disponible" => $vehicule_disponible,
            "Vehicule_total" => $vehicule_total,
            "demandes_encours" => $demandes_encours,
            'charroi_traite' => $traites
        ];

        return response()->json($demande_tab);
    }

    public function lastDemande(Request $request)
    {
        return response()->json(Demande::where('user_id', $request->id)->latest()->take(2)->get());
    }

    public function getdemande(Request $request)
    {

        return response()->json(Demande::where('user_id', $request->id)->get());
    }
    public function getAllDemande(Request $request)
    {
        $id = $request->id;
        $demandes = Demande::where('user_id', $id)->get();
        return DemandeResource::collection($demandes);
    }

    public function getDemandeTraite(Request $request)
    {
        $id = $request->id;
        $demandes = Demande::where('user_id', $id)->where('status', '1')->get();
        return DemandeResource::collection($demandes);
    }

    public function getUserByName(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $query = $request->name;

        $url = 'http://10.143.41.70:8000/promo2/odcapi/?method=getUserByName&name=' . $query;
        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json('users');

            $filteredData = collect($data)
                ->where(function ($item) use ($query) {
                    return stripos($item['first_name'], $query) !== false
                        || stripos($item['last_name'], $query) !== false;
                })
                ->map(function ($item) {
                    return
                        ["nom" => $item['first_name'] . ' ' . $item['last_name'], "id" => $item["id"]];
                })
                ->toArray();

            return response()->json($filteredData);
        }

        return response()->json(['error' => 'No users found'], 404);
    }
}
