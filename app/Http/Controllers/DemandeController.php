<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Site;
use App\Models\User;
use App\Models\Course;
use App\Models\Demande;
use App\Models\Passager;
use App\Models\UserInfo;
use App\Models\Vehicule;
use App\Models\Chauffeur;
use App\Models\Delegation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ChefCharroiEmail;
use Illuminate\Support\Facades\DB;
use App\Jobs\TraitementDemandeMail;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;


use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Jobs\CreationDemandeMailManager;
use App\Notifications\AgentNotification;

use App\Jobs\ValidationManagerDemandeMail;
use App\Notifications\ManagerNotification ;

use Illuminate\Support\Facades\Notification;

use App\Http\Controllers\envoyerMailAuManager;
use App\Notifications\UserDelegueNotification;

use App\Notifications\MailCharroiToAgentDemandeRejecte;
use App\Notifications\ChefCharroiEmail as NotificationsChefCharroiEmail;

use Carbon\Carbon;


class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Session::get('authUser')) {
            $paginate = false;
            $view = 'grid';
            $user_id = Session::get('authUser')->id;

            $demandes = Demande::Where('user_id', $user_id)->orderBy('id', 'desc')->paginate(7);
            $demandesGrid = Demande::Where('user_id', $user_id)->orderBy('id', 'desc')->paginate(15);

            if(!empty($_GET['page'])){
                $paginate = true;
            }

            if(!empty($_GET['view'])){
                $view = $_GET['view'];
            }

            $demandes->withPath('?view=list');
            $demandesGrid->withPath('?view=grid');

            $demandes_validees = Demande::where('is_validated', 1)->get();
            $demandes_traitees = Demande::where('status', 1)->get();

            $vehicules = Vehicule::all();

            $chauffeurs = Chauffeur::all();
            $courses = Course::all();


            return view('demandes.index', compact('demandes', 'demandesGrid', 'chauffeurs', 'vehicules', 'courses','paginate','view'));
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sites = Site::all();
        return view('demandes.create', compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'choix' => 'required|in:choix-liste,choix-carte',
            'motif' => 'required:demandes',
            'date' => 'required:demandes',
            'lieu_depart' => 'required_if:choix,choix-carte',
            'destination' => 'required_if:choix,choix-carte',
            'lieu_depart1' => 'required_if:choix,choix-liste',
            'destination1' => 'required_if:choix,choix-liste',
            'nbre_passagers' => 'required:demandes',
            'longitude_depart' => 'required_if:choix,choix-liste',
            'latitude_depart' => 'required_if:choix,choix-liste',
            'longitude_destination' => 'required_if:choix,choix-liste',
            'latitude_destination' => 'required_if:choix,choix-liste',
            'longitude_depart1' => 'required_if:choix,choix-carte',
            'latitude_depart1' => 'required_if:choix,choix-carte',
            'longitude_destination1' => 'required_if:choix,choix-carte',
            'latitude_destination1' => 'required_if:choix,choix-carte',
            'date_deplacement' => 'required|after:today'
        ]);
        $dems = Demande::get()->count();

        $ticket = 'DEM-'.rand(1,$dems).date('Y');
        $user_id = Session::get('authUser')->id;

        $status = '0';
        $is_validated = 0;
        $user_info = UserInfo::where('user_id', $user_id)->first();
        $email_manager = $user_info->email_manager;
        $manager = User::where('email', $email_manager)->first();
        $Url = Str::random(16);
        // dd($Url);

        if ($manager) {
            $manager_id = $manager->id;
            // dd($manager_id);
            $demande = Demande::create([
                'ticket' => $ticket,
                'motif' => $request->motif,
                'date' => $request->date,
                'destination' => !empty($request->destination) ? $request->destination : $request->destination1,
                'nbre_passagers' => $request->nbre_passagers,
                'lieu_depart' => !empty($request->lieu_depart) ? $request->lieu_depart : $request->lieu_depart1,
                'longitude_depart' => !empty($request->longitude_depart) ? $request->longitude_depart : $request->longitude_depart1,
                'latitude_depart' => !empty($request->latitude_depart) ? $request->latitude_depart : $request->latitude_depart1,
                'longitude_destination' => !empty($request->longitude_destination) ? $request->longitude_destination : $request->longitude_destination1,
                'latitude_destination' => !empty($request->latitude_destination) ? $request->latitude_destination : $request->latitude_destination1,
                'date_deplacement' => $request->date_deplacement,
                'user_id' => $user_id,
                'status' => $status,
                'is_validated' => $is_validated,
                'Url' => $Url,
                'manager_id' => $manager_id
            ]);
           
            $demande->manager_id = $manager_id;
            $demande->update();
            // dd($demande);
            //CODE POUR ENVOYER UN MAIL AU MANAGER DE L'AGENT QUI SOUMET SA DEMANDE

            // Données à envoyer
         
            $nombre = (int) $request->input('nombre-passagers');
           
           
            
            for ($i = 0; $i < $nombre; $i++) {
              
                if ($request->has("passager{$i}")) {
                   
                    $response = Http::get('http://10.143.41.70:8000/promo2/odcapi/?method=getUsers');

                    if ($response->successful()) {
                        if(strpos($request->input("passager{$i}"), ' ') !==false) {

                        $passager = explode(' ',$request->input("passager{$i}"));
                               $firstname = $passager[0];
                               $lastname = $passager[1]; 
                               
                            
                            $users = $response->json();
                            $passager_lastname = collect($users['users'])->firstWhere('last_name', $lastname); 
                            
                    if($passager_lastname){
                        Passager::create([
                            'user_id' => $passager_lastname['id'],
                            'demande_id'=>$demande->id,
                           
                        ]);
                    } 
                    else{
                        Passager::create([
                            'user_id' =>null,
                            'demande_id'=>$demande->id,
                 
                        ]);
                    }
                }
                else{
                    Passager::create([
                        'user_id' =>null,
                        'demande_id'=>$demande->id,
                        
                    ]);
                }
                  
                }
                
            }
        }
       
    
            $data = (object) [
                'id' => $demande->id,
                'Url' => $demande->Url,
                'subject' => 'Nouvelle demande',
                'name' => $manager->username,
                'sender' => $manager,
                'to' => 'manager'
            ];

            CreationDemandeMailManager::dispatch($data)->delay(now()->addMinutes(1));

            $delegations = Delegation::where('manager_id', $manager->id)->where('status', 1)->get();

            foreach ($delegations as $delegation) {
                $user = $delegation->user()->firstOrFail();

                $data = (object) [
                    'id' => $demande->id,
                    'Url' => $demande->Url,
                    'subject' => 'Nouvelle demande',
                    'name' => $user->username,
                    'sender' => $user,
                    'to' => 'delegue',

                ];

                CreationDemandeMailManager::dispatch($data)->delay(now()->addMinutes(1));
            }
        }
        else{
            return back()->with("message","Le manager ne se trouve pas dans le système");
        }

        return redirect()->route('demandes.index');
    }


    /**
     * Display the specified resource.
     */

    public function show(string $Url)
    {

        // dd($Url);
        $demandes = Demande::with('courses')->where('Url', $Url)->firstOrFail();
        $courses = Course::where('demande_id', $demandes->id)->first();
        $demande = Demande::where('Url', $Url)->first();
        $demande_id = $demande->id;
        $passagers = Passager::where('demande_id', $demande_id)->get()->pluck('user_id');
        foreach ($passagers as $item){
            $passager_id [] = $item;
        }
        if(count($passagers)==0){
            $vehicules = [];
            $chauffeur_name = null;
            $chauffeurs = [];
            $vehicule = null;
            $passager_name = [];
            return view("demandes.show", compact('demandes', 'vehicule', 'courses', 'vehicules', 'chauffeur_name', 'chauffeurs','passager_name'));
        }
        $response = Http::get('http://10.143.41.70:8000/promo2/odcapi/?method=getUsers');

        if ($response->successful()) {
                $users = $response->json();
                $passager = collect($users['users'])->whereIn('id', $passager_id);
                foreach ($passager as $item1){
                    $passager_name [] = $item1['first_name'].' '.$item1['last_name'];
                }
                foreach ($passager_id as $id) {
                   if($id==null){
                    $passager_name [] = "Inconnu";
                   }
                }
                
                
        }
       
    
        if (!$courses) {
            $vehicules = [];
            $chauffeur_name = null;
            $chauffeurs = [];
            $vehicule = null;
            
            return view("demandes.show", compact('demandes', 'vehicule', 'courses', 'vehicules', 'chauffeur_name', 'chauffeurs','passager_name'));
        }
        $vehicule = Vehicule::where('id', $courses->vehicule_id)->first();

        $chauffeurs = Chauffeur::where('id', $courses->chauffeur_id)->first();
        $chauffeur_name = User::where('id', $chauffeurs->user_id)->first();

        $chauffeurs = Chauffeur::with('user')->get();
        $vehicules = Vehicule::all();


        // dd($chauffeurs);
    

        return view("demandes.show", compact('demandes', 'courses', 'vehicules', 'chauffeur_name', 'chauffeurs', 'vehicule','passager_name'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Demande $demande)
    {
        $demandes = $demande;
        $sites = Site::all();
        return view('demandes.edit', compact('demandes', 'sites'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Demande $demande)
    {
        $demande->update([
            'motif' => $request->motif,
            'destination' => $request->destination,
            'nbre_passagers' => $request->nbre_passagers,
            'lieu_depart' => $request->lieu_depart,
            'date_deplacement' => $request->date_deplacement

        ]);

        return redirect()->route('demandes.index')->with('success', 'Votre demande a été mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demande $demande)
    {
        $demande->delete();
        return back()->with("success", "suppression reussie");
    }


    public function submit(Request $request)
    {
        return redirect()->route('demande.success');
    }


    public function envoyerMailAuChefCharroi($id)
    {


        $chefs_charroi = User::role('charroi')->get();
        // dd($chefs_charroi);
        $demande = Demande::find($id);
        $is_validated_by = Session::get('authUser')->id;
        foreach ($chefs_charroi as $chef_charroi) {

            $data = (object) [
                'id' => $demande->id,
                'Url' => $demande->Url,
                'subject' => 'Nouvelle demande',
                'name' => $chef_charroi->username,
                'charroi_name' => $chef_charroi->username,
                'to' => 'chef_charroi'
            ];

            ValidationManagerDemandeMail::dispatch($data);
        }

        $is_validated = 1;
        $demande->is_validated = $is_validated;
        $demande->is_validated_by = $is_validated_by ;

        $demande->update();
        // dd($demande);

        return back()->with("success", "demande validée avec succès");
    }

    public function mailAnnulationDemandeParLeManager(Request $request, $id)
    {
        $demande = Demande::find($id);
        $user_id = $demande->user_id;
        $agent = User::where('id', $user_id)->first();
        $is_validated_by = Session::get('authUser')->id;
        $demande->raison = $request->raison;

        $data = (object) [
            'id' => $demande->id,
            'Url' => $demande->Url,
            'subject' => 'Demande Annulée',
            'raison' => $request->raison,
            'etat' => ' rejetée',
            'name' => $agent->username,
            'to' => 'agent'
        ];

        ValidationManagerDemandeMail::dispatch($data)->delay(now()->addMinutes(1));

        $is_validated = 2;
        $demande->is_validated = $is_validated;

        $status = '2';
        $demande->status = $status;
        $demande->is_validated_by = $is_validated_by ;

        $demande->update();
        //dd($demande);


        return back()->with("annuler", "demande annulée avec succès");
    }


    public function demandeCollaborateurs()
    {

        if (Session::get('userIsManager')) {
            $paginate = false;
            $view = 'grid';

            $email_manager = Session::get('userIsManager')->email_manager;

            $collaborateurs = Session::get('userIsManager')::where('email_manager', $email_manager)->get();
            foreach ($collaborateurs as $collaborateur) {
                $id[] = $collaborateur->user_id;
            }

            $demandes = Demande::whereIn('user_id', $id)->paginate(7);
            $demandesGrid = Demande::WhereIn('user_id', $id)->paginate(15);

            if(!empty($_GET['page'])){
                $paginate = true;
            }

            if(!empty($_GET['view'])){
                $view = $_GET['view'];
            }

            $demandes->withPath('?view=list');
            $demandesGrid->withPath('?view=grid');

            return view('demandes.collaborateurs', compact('demandes','demandesGrid','paginate','view'));
        }
    }
    public function demandeDelegue()
    {
        if (Session::get('delegation')) {
            $paginate = false;
            $view = 'grid';

            $managers_id = Session::get('delegation');
            $delg = [];
            $demandesTest = [];
            $demandesGridTest = [];

            $user_id = Session::get('authUser')->id;
            
            $date_now = Carbon::now();

            foreach ($managers_id as $manager_id) {
                $delegations = Delegation::where('user_id', $user_id)
                                            ->where('manager_id', $manager_id)
                                            ->where('date_fin','>',$date_now)
                                            ->get();

                $demandes_temp = Demande::where('manager_id', $manager_id)
                                    ->orderBy('id','desc')
                                    ->paginate(7);
            
                $demandesGrid_temp = Demande::where('manager_id', $manager_id)
                                        ->orderBy('id', 'desc')
                                        ->paginate(15);
            }
            
            foreach ($delegations as $delegation) {
                $date_debut = $delegation->date_debut;
                $date_fin = $delegation->date_fin;

                // echo $date_debut." | ".$date_fin."<br>";

                foreach($demandes_temp as $demande_temp){
                    // echo $demande_temp->created_at."<br>";
                    if(($demande_temp->created_at >= $date_debut) && ($demande_temp->created_at <= $date_fin ) ){
                        // echo $demande_temp->ticket."<br>";
                        array_push($demandesTest,$demande_temp);
                    }
                }

                foreach($demandesGrid_temp as $demandeGrid_temp){
                    // echo $demandeGrid_temp->created_at."<br>";
                    if(($demandeGrid_temp->created_at >= $date_debut) && ($demandeGrid_temp->created_at <= $date_fin ) ){
                        // echo $demandeGrid_temp->ticket."<br>";
                        array_push($demandesGridTest,$demandeGrid_temp);
                    }
                }
            }

            $demandes = Demande::orderBy('id', 'desc');
            $demandesGrid = Demande::orderBy('id', 'desc');

            foreach($demandesTest as $demandeTest){
                $demandes = $demandes->orWhere('id', $demandeTest->id);
            }

            foreach($demandesGridTest as $demandeGridTest ){
                $demandesGrid = $demandesGrid->orWhere("id",$demandeGridTest->id);
            }

            $demandes = $demandes->paginate(7);
            $demandesGrid = $demandesGrid->paginate(15);

            if(!empty($_GET['page'])){
                $paginate = true;
            }

            if(!empty($_GET['view'])){
                $view = $_GET['view'];
            }

            $demandes->withPath('?view=list');
            $demandesGrid->withPath('?view=grid');

            return view('demandes.delegue', compact('demandes','demandesGrid','paginate','view'));
        }
    }

    public function demandeCharroi()
    {
        if (Session::get('authUser')->hasRole('charroi')) {
            $paginate = false;
            $view = 'grid';

            $demandes = Demande::where('is_validated', 1)->orderBy('id', 'desc')->paginate(7);
            $demandesGrid = Demande::Where('is_validated', 1)->orderBy('id', 'desc')->paginate(15);
            // dd($demandes,$demandesGrid);
            $vehicules = Vehicule::where('disponibilite', 0)->get();
            $chauffeurs = Chauffeur::all();

            if(!empty($_GET['page'])){
                $paginate = true;
            }

            if(!empty($_GET['view'])){
                $view = $_GET['view'];
            }

            $demandes->withPath('?view=list');
            $demandesGrid->withPath('?view=grid');

            return view('demandes.charroi', compact('demandes','demandesGrid', 'chauffeurs', 'vehicules', 'paginate','view'));
        }
    }

    public function rejetDemandeParCharroi(Request $request, $id)
    {

        $demande = Demande::find($id);
        $user_id = $demande->user_id;
        $agent = User::where('id', $user_id)->first();
        $traited_by = Session::get('authUser')->id;
        $demande->raison = $request->raison;
        $data = (object) [
            'id' => $demande->id,
            'Url' => $demande->Url,
            'subject' => 'Demande Rejetée',
            'raison' => $request->raison,
            'etat' => 'rejetée',
            'name' => $agent->username,
            'sender' => $agent
        ];

        TraitementDemandeMail::dispatch($data)->delay(now()->addMinutes(1));

        $status = '2';
        $demande->status = $status;
        $demande->traited_by = $traited_by;

        $demande->update();

        return back()->with("rejected", "Demande rejetée avec succès");
    }
    
}
