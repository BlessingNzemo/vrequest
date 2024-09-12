<?php

namespace App\Http\Controllers;

use App\Jobs\EnvoiMailDelegue;
use Exception;
use App\Models\User;
use App\Models\Delegation;
use App\Notifications\UserDelegueNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DelegationController extends Controller
{
    public function index()
   {
    if(Session::get('authUser') && Session::get('userIsManager')){
        $manager_id = Session::get('authUser')->id;
        
        $delegations = Delegation::where('manager_id',$manager_id)->orderBy('id', 'desc')->paginate(5);
        
        return view ('delegations.index',compact('delegations'));
    }    
    
    
   }
   public function create()
    {
        $delegations = Delegation::all();
        return view('delegations.create', compact('delegations'));
    }

    public function store(Request $request)
    {
        $manager_id = Session::get('authUser')->id;
        
        $user_name=$request->user_id;

        $request->validate([
            'date_debut' => 'required|after:today',
            'date_fin' => 'required|after:date_debut',
            'user_id' => 'required|different:manager_id'
        ]);
        $sepNom = explode(" ",$user_name);

        if(count($sepNom)>1){
            if(count($sepNom)==2){
                $first_name = $sepNom[0];
            
                $last_name = $sepNom[1];

                // dd( $first_name , $last_name); 
                $user = User::where('first_name',$first_name) 
                            ->where('last_name','LIKE',$last_name.'%') 
                            ->first();
                }
            else if(count($sepNom)>=3){
                $first_name = $sepNom[0];
            
                $last_name = $sepNom[1];

                $small_name = $sepNom[2];
                // dd($first_name , $last_name,$small_name);
                $user = User::where('first_name',$first_name) 
                            ->where('last_name','LIKE',$last_name.'%') 
                            ->where('last_name','LIKE','%'.$small_name.'%')
                            ->first();
                }
            else{

            }
            
                        // exit();
            // dd($user);  
            if( !empty($user) ){
                $user_id = $user -> id;
                
                //  Condition pour ne pas se déléguer soit même    
                if($user_id != $manager_id){
                    // Condition pour ne plus déléguer la même personne 2 fois dans la même période
           
                    $delegations = Delegation::where('user_id',$user_id)
                                        ->where('manager_id', $manager_id)
                                        ->get();
                    foreach($delegations as $delegation){
                        $delegations_date_fin[] = $delegation->date_fin;
                    
                        if(count($delegations_date_fin)>0){
                            foreach($delegations_date_fin as $delegation_date_fin){
                                if($delegation_date_fin > $request->date_debut){
                                    return back()->with('failed', 'vous avez déjà délégué cet utilisateur dans cette même période');
                                }
                            }
                    
                        }
                    }
                    
                    $delegation =Delegation::create([
                        'motif' =>  $request->motif,
                        'user_id' => $user_id,
                        'manager_id' => $manager_id,
                        'date_debut' => $request->date_debut,
                        'date_fin' => $request->date_fin,
                    ]);
        
                    //Envoyer un mail au user qu'on veut déléguer
        
                    $data =(object)[
                        'id' => $delegation -> id ,
                        'subject' => 'Nouvelle Délégation',
                        'name' => $user -> username,
                        'Motif' => $delegation ->motif,
                        'sender' => $user
                    ];

                    EnvoiMailDelegue::dispatch($data)->delay(now());
                                        
                    // try{
                    //     $user -> notify(new UserDelegueNotification($data));
                    // }
                    // catch(Exception $e){
                    //     // dd($e);
                    // }
        
                    return  redirect()->route("delegations.index",compact('delegations'))
                                      ->with('success', 'votre délégation a été créée avec succès');
                }
                else{
                    return back()->with('failed', 'vous ne pouvez pas vous déléguer vous-même, 
                    veuillez choisir un autre délégué');
                }
                
            }
            else{
                return back()->with('failed', 'ce délégué ne s\'est pas encore enregistré dans l\'application');
            }
        }
        else{
            return back()->with('failed', 'le délégué ne s\'est pas encore enregistré dans l\'application');
        }
        
        // dd($delegation);
        
        
    }
    
    public function show(Delegation $delegation)
    {
       
        return view('delegations.show', compact('delegation'));
    }
    
    public function edit(Delegation $delegation)
    {    
        $delegations = $delegation;
        return view('delegations.edit', compact('delegation'));
    }
    
    public function update(Request $request, Delegation $delegation)
    {
       
        $delegation->update([
            'user_id'=>$request->user_id,
            'date_debut'=>$request->date_debut,
            'date_fin'=>$request->date_fin,
        ]);


        return redirect()->route('delegations.index')->with('success', 'Modification réussie');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delegation $delegation)
    {
        $delegation->delete();
        return back()->with('success', 'La délégation a été supprimée avec succès');
    }
    
    public function restore(Delegation $delegation)
    {
        $delegation ->restore();

        return redirect()->route('delegations.index')
                        ->with('success', 'La délégation a été restauré avec succès.');
    }

    public function delegueVue(){
        if(Session::get('authUser')){
            $user_id = Session::get('authUser')->id; 
            $delegations= Delegation::where('user_id',$user_id)->get();
            foreach ($delegations as $delegation){
                $managers_id[] =$delegation->manager_id;
            }
            
            for($i=0;$i<count($managers_id);$i++){
                $manager_id = $managers_id[$i];
                $managers[] = User::where('id',$manager_id)->first();
            }

            return view ('delegations.delegue',compact('delegations'));
        }
    }

    
}


      
