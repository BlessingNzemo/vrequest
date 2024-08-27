<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(){
        return view('sites.index');
    }
    public function getCoordinates($nom)
    {
        $site = Site::where('nom', $nom)->first(); 
        if (!$site) {
            return response()->json(['erreur' => 'Lieu non trouvé'], 404);
        }
        return response()->json([
            'latitude' => $site->latitude,
            'longitude' => $site->longitude,
        ]);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'nom' => 'required:sites',
            'longitude' => 'required:sites',
            'latitude' => 'required:sites',
            

        ]);

     Site::create([
            'nom' => $request->nom,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude
        ]);


        return view('sites.index');
    }
    
    
}
