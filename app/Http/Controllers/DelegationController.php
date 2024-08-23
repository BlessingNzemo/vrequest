<?php

namespace App\Http\Controllers;
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
        
        $delegations= Delegation::leftJoin('users','users.id','delegations.manager_id')  
                                    ->where('delegations.manager_id',$manager_id)
                                    ->get();
        
        // dd($delegations);
    }
        
    return view ('delegations.index',compact('delegations'));
        
    
    
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
            'date_debut' => 'required',
            'date_fin' => 'required',
            'user_id' => 'required|different:manager_id'
        ]);
        $sepNom = explode(" ",$user_name);
        
        $first_name = $sepNom[0];
        $last_name = $sepNom[1];
        

        $user = User::where('first_name',$first_name) 
                    ->where('last_name',$last_name) 
                    ->first();
        // dd($user);  
        if( $user ){
            $user_id = $user -> id;
            
            if($user_id != $manager_id){
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
                    'Motif' => $delegation ->motif
                ];
                
                try{
                    $user -> notify(new UserDelegueNotification($data));
                }
                catch(Exception $e){
                    //print($e);
                }
    
                return redirect()->route("delegations.index");
            }
            else{
                return back()->with('failed', 'vous ne pouvez pas vous déléguer vous-même, 
                veuillez choisir un autre délégué');
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


      
