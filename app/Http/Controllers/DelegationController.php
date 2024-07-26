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
    if(Session::get('authUser')){
        $manager_id = Session::get('authUser')->id; 
        // dd($manager_id);

        $delegations= Delegation::leftJoin('users','users.id','delegations.manager_id')  
                                    ->where('delegations.manager_id',$manager_id)
                                    ->get();
        
    }
    // dd($delegations);
    return view ('delegations.index',compact('delegations'));
   }
   public function create()
    {
        $delegations = Delegation::all();
        return view('delegations.create', compact('delegations'));
    }

    public function store(Request $request)
    {
        // $validateData = $request->validate([
        //     'user_id' => 'required:choix,users',
        //     'motif' => 'required:delegations',
        //     'date_debut' => 'required:delegations',
        //     'date_fin' => 'required_if:delegations',
            
        //     ]);
        $manager_id = Session::get('authUser')->id;
        $user_name=$request->user_id;
        // dd($user_name);
        
        // // $user = User::leftJoin('users','users.id','delegations.user_id')  
        // //                         ->where('delegations.user_id',$user_id)
        // //                         ->get();
        // dd($user);
        // $user_id = $user -> id;
        // $user = User::where('first_name'.''.'last_name', $user_name)->get();
        // dd($user);
        $sepNom = explode(" ",$user_name);
        
        $first_name = $sepNom[0];
        $last_name = $sepNom[1];
        

        $user = User::where('first_name',$first_name) 
                    ->where('last_name',$last_name) 
                    ->first();
        // dd($user);
        $user_id = $user -> id;
        // dd($user_id);
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
        // dd($delegation);
        
        return redirect()->route("delegations.index");
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
        return back()->with('success', 'délégation supprimée');
    }

    
}


      
