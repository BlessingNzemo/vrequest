<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\View\View;
use App\Models\Delegation;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Auth\LoginRequest;
use Spatie\Permission\Models\Permission;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        if(Session::has('user')){
          

           return redirect()->route('dashboard');
        }
        
        return View('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
       $roles = Role::all()->count();
       $permissions = Permission::all()->count();
       
      
       
       if($permissions == 0){
        //créations des permissions
        Permission::create(['name'=>'enregistrer']);
        Permission::create(['name'=>'lire']);
        Permission::create(['name'=>'modifier']);
        Permission::create(['name'=>'supprimer']);
        Permission::create(['name'=>'lire_vehicule']);
        Permission::create(['name'=>'enregistrer_vehicule']);
        Permission::create(['name'=>'modifier_vehicule']);
        Permission::create(['name'=>'supprimer_vehicule']);
        Permission::create(['name'=>'lire_demande']);
        Permission::create(['name'=>'enregistrer_demande']);
        Permission::create(['name'=>'modifier_demande']);
        Permission::create(['name'=>'supprimer_demande']);
        Permission::create(['name'=>'lire_site']);
        Permission::create(['name'=>'enregistrer_site']);
        Permission::create(['name'=>'modifier_site']);
        Permission::create(['name'=>'supprimer_site']);
        Permission::create(['name'=>'lire_chauffeur']);
        Permission::create(['name'=>'enregistrer_chauffeur']);
        Permission::create(['name'=>'modifier_chauffeur']);
        Permission::create(['name'=>'supprimer_chauffeur']);
        Permission::create(['name'=>'lire_course']);
        Permission::create(['name'=>'enregistrer_course']);
        Permission::create(['name'=>'modifier_course']);
        Permission::create(['name'=>'supprimer_course']);
        Permission::create(['name'=>'lire_delegation']);
        Permission::create(['name'=>'enregistrer_delegation']);
        Permission::create(['name'=>'modifier_delegation']);
        Permission::create(['name'=>'supprimer_delegation']);
       }

       if($roles==0){
        //création des rôles

        $charroi = Role::create(['name' => 'charroi']);
        $chauffeur = Role::create(['name' => 'chauffeur']);
        $admin = Role::create(['name' => 'admin']);

        //on assigne les permissions au charroi
        $charroi->givePermissionTo('lire_vehicule');
        $charroi->givePermissionTo('enregistrer_vehicule');
        $charroi->givePermissionTo('modifier_vehicule');
        $charroi->givePermissionTo('supprimer_vehicule');
        $charroi->givePermissionTo('lire_chauffeur');
        $charroi->givePermissionTo('enregistrer_chauffeur');
        $charroi->givePermissionTo('modifier_chauffeur');
        $charroi->givePermissionTo('supprimer_chauffeur');
        $charroi->givePermissionTo('lire_course');
        $charroi->givePermissionTo('enregistrer_course');
        $charroi->givePermissionTo('modifier_course');
        $charroi->givePermissionTo('supprimer_course');

        //on assigne les permissions à l'admin
        $admin->givePermissionTo('lire');
        $admin->givePermissionTo('enregistrer');
        $admin->givePermissionTo('modifier');
        $admin->givePermissionTo('supprimer');
        $admin->givePermissionTo('lire_site');
        $admin->givePermissionTo('enregistrer_site');
        $admin->givePermissionTo('modifier_site');
        $admin->givePermissionTo('supprimer_site');
        

       }
       
       
      

        
        $data = [
            "username"=>$request->username,
            "password"=>$request->password
        ];
    
        
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post('http://10.143.41.70:8000/promo2/odcapi/?method=login', $data);
    
        if ($response->successful()) {
            $request->session()->regenerate();
        $responsefinal= $response->json();

            if(User::where('email',$responsefinal['user']['email'])->first()){
                
                Session::put('user',$request->username);
                $user = User::find($responsefinal['user']['id']);
                $email = $user->email;
                $manager = UserInfo::where('email_manager',$email)->first();
                if($manager != null){
                    Session::put('userIsManager',$manager);
                   
                }
                
                $user_delegation = Delegation::where('user_id',$user->id)->get();
                $delegation = [];
                foreach($user_delegation as $item){
                 $delegation[] = $item->manager_id;
                }
                if(count($delegation)>0){
                     Session::put('delegation',$delegation);
                }
                
              
                
                Session::put('authUser',$user);
                return redirect()->route('dashboard');
            }
            else{
             
                $id = $responsefinal['user']['id'];
                 Session::put('user',$request->username);
                 Session::put('manager',$request->username);
                return redirect()->route('register')->with('id',$id);
            }
        
       
        } 
        else {
            session()->flash('status','username or password incorrect');
            session()->reflash(1);
            return redirect()->route('login');
        }

       
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Session::forget('delegation');
        Session::forget('user');
        Session::forget('authUser');
        Session::forget('userIsManager');
        Auth::guard('web')->logout();

        return redirect()->route('login');
    }
}
