<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Chauffeur;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('role.index',compact('roles'));
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
    public function store(Request $request,User $user)
    {
        
        $role = Role::create(['name'=>$request->name]);
        
        return back()->with('status','Enregistrement reussi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    
        $role = Role::find($id);
       /*
        $rolename = $role->name;

    
        $permissions = Permission::whereHas('users', function ($query) use($rolename){
            $query->whereHas('roles', function ($q) use($rolename) {
                
                $q->where('name', $rolename);
            });
        })->get();
        */
        $permissions = $role->permissions;
     
        
       
        
       
    
        $modelFiles = scandir(app_path('Models'));

        // Filtrer les fichiers de modèles
        $models = array_diff($modelFiles, ['.', '..']);
        
        // Supprimer l'extension .php des noms de fichiers
        $models = array_map(function($model) {
            return pathinfo($model, PATHINFO_FILENAME);
        }, $models);
        $modelname = [];
        foreach($models as $model) {
            $modelname[] = $model;
        }
      
        $tab = [];
       
        
        $per = ["lire","enregistrer","modifier","supprimer"];
        $per_vehicule = ["lire_vehicule","enregistrer_vehicule","modifier_vehicule","supprimer_vehicule"];
        $per_demande = ["lire_demande","enregistrer_demande","modifier_demande","supprimer_demande"];
        $per_site = ["lire_site","enregistrer_site","modifier_site","supprimer_site"];
        $per_chauffeur = ["lire_chauffeur","enregistrer_chauffeur","modifier_chauffeur","supprimer_chauffeur"];
        $per_course = ["lire_course","enregistrer_course","modifier_course","supprimer_course"];
        $per_delegation = ["lire_delegation","enregistrer_delegation","modifier_delegation","supprimer_delegation"];
        $roleId=$role->id;
  
        
        return view('role.detail',compact('role','modelname','permissions','per','tab','roleId','per_vehicule','per_demande','per_site','per_chauffeur','per_course','per_delegation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        return back()->with('status', 'Modification reussi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->delete();
        return back()->with('status','Suppression reussie');
    }
    
      
    public function assignRoles($role,$user){
        
        /*$user = auth()->user();
    
        $assignRole =  $user->assignRole('agent');
        */
        $users = User::find($user);
        $users->assignRole($role);
        if($role == 'chauffeur'){
            Chauffeur::create([
                'user_id' =>$user
            ]);
        }
       
        $roles = Role::findByName($role);
        
        $permissions = $roles->permissions;
        
       
        foreach($permissions as $permission){
          $users->givePermissionTo($permission->name);
        }
       
     
       return back()->with('status','rôle attribué avec succès');
    }
    public function desactiverRoles($role,$user){
        $users = User::find($user);

        $users->removeRole($role);
        if($role == 'chauffeur'){
           $chaffeur = Chauffeur::where('user_id',$user);
           $chaffeur->delete();
        }
        $roles = Role::findByName($role);
        $permissions = $roles->permissions;
        foreach($permissions as $permission){
          $users->revokePermissionTo($permission->name);
        }
       
        return back()->with('status','rôle desactivé avec succès');
    }
    public function RoleAsPermissions(){
        $charroi = Role::findByName('charroi');
        $admin = Role::findByName('admin');
        $admin->givePermissionTo('lire');
        $admin->givePermissionTo('enregistrer');
        $admin->givePermissionTo('modifier');
        $admin->givePermissionTo('supprimer');
        $charroi->givePermissionTo('lire_vehicule');
        $charroi->givePermissionTo('enregistrer_vehicule');
        $charroi->givePermissionTo('modifier_vehicule');
        $charroi->givePermissionTo('supprimer_vehicule');
    }
    
}
