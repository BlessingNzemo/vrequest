<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Course;
use App\Models\Demande;
use App\Models\UserInfo;
use App\Models\Vehicule;
use App\Models\Chauffeur;
use Illuminate\Http\Request;
use App\Notifications\AgentNotification;
use App\Notifications\ManagerNotification;
use App\Notifications\ChauffeurNotification;
use App\Notifications\AgentNotificationDemandeAcceptee;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // avoir directement accès aux infos du chauffeur appartir de la course
        // $courses = Course::with(['vehicule', 'chauffeur', 'demande'])->get();
        // $vehicules = Vehicule::all();
        // $chauffeurs=Chauffeur::all();
        // $demandes=Demande::all();
        //  return view("courses.index",compact('courses','vehicules','chauffeurs','demandes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $demande = Demande::findOrFail($request->demande_id);
        // dd($demande);
        $vehicule = Vehicule::findOrFail($request->vehicule_id);
        $courses = Course::where('vehicule_id',$request->vehicule_id)->get();
        $chauffeurs = Course::where('chauffeur_id',$request->chauffeur_id)->get();
        $date =  date("Y-m-d", strtotime($demande->date_deplacement));
        $time = date("H", strtotime($date));
        $nombre_passagers = $demande->nbre_passagers;
      
        foreach ($courses as $course) {
            $time_course [] = date("H", strtotime($course->date));
           
        }
      
        foreach ($courses as $course) {
           $date_course =  date("Y-m-d", strtotime($course->date));
            if($date_course == $date){
               
                if(in_array($time,$time_course)){
                    //dd(1);
                    return back()->with('failed', 'course non traité car le véhicule sera occupé à cette heure');
                }
            }
        }
        foreach ($chauffeurs as $chauffeur) {
            $time_chauffeur [] = date("H", strtotime($chauffeur->date));
        }
         
        foreach ($chauffeurs as $chauffeur) {
            $date_chauffeur =  date("Y-m-d", strtotime($chauffeur->date));
            if($date_chauffeur == $date){
               
                if(in_array($time,$time_chauffeur)){
                  
                    return back()->with('failed', 'course non traité le chauffeur sera occupé à cette heure');
                }
            }
        }

        if($vehicule->capacite<$nombre_passagers){
            return back()->with('failed', 'course non traité car le nombre des passagers depasse la capacité du véhicule');
        }
        
        
        $vehicule->disponibilite  = 1;
        $vehicule->update();
        $demande->status = '1';
        
        $demande->update();
       

        $vehicule = Vehicule::findOrFail($request->vehicule_id);

        // Vérifier si le véhicule est disponible
        if ($vehicule->disponibilite == 1) {
            $vehicule->disponibilite = 0; // Mettre le véhicule en indisponible
            $vehicule->save();
        }
        
    
        
        $course = Course::create([
            'vehicule_id' => $request->vehicule_id,
            'chauffeur_id' => $request->chauffeur_id,
            'demande_id'=>$request->demande_id,
            'commentaire'=>$request->commentaire,
            "date"=>$date
        ]);

        


       
        $user_id=$demande->user_id;
        $agent= User::findOrFail($user_id);

        //dd($agent);
        $user_info=UserInfo::where('user_id',$user_id)->first();
        $email_manager=$user_info->email_manager;
        $manager=User::where('email',$email_manager)->first();
        

        $chauffeur_id = $course -> chauffeur_id;
        $chauffeur_info = Chauffeur::where('id', $chauffeur_id)->first();
        // dd( $chauffeur_info);
        $chauffeur_user_id = $chauffeur_info -> user_id;
        
        $chauffeur = User :: where('id',$chauffeur_user_id)->first();
        // dd($chauffeur);
        $data =(object)[
            'id' => $demande->id ,
            'subject' => 'Nouvelle demande',
            'manager_name' => $manager->username,
            'agent_name' => $agent -> username,
            'chauffeur' => $chauffeur -> username,
            'etat' => ' traitée',
            'course_id' => $course->id
        ];
        
        try{
            $agent -> notify(new AgentNotificationDemandeAcceptee($data));
            $manager -> notify(new ManagerNotification($data));  
            $chauffeur -> notify(new ChauffeurNotification($data)); 
        }
        catch(Exception $e){
            // print($e);
        }
          
        // dd($demande);

            return back()->with('success', 'Course enregistrée avec succès.');
        } 




    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
