<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        /*
        if(Session::get('authUser')->hasRole('charroi')){
            $demandes =  Demande::where('is_validated',1);
            $demandes_validees = $demandes->get();
 
            $courses = Course::leftJoin('demandes','demandes.id','courses.demande_id')  ;
            dd($courses);
        }else if(Session::get('authUser')->hasRole('chauffeur')){
            $user_id = Session::get('authUser')->id;
            $demandes = Demande::where('user_id',$user_id);
            //dd($demandes);
            $demandes_validees = $demandes->where('is_validated',1)->get();

            $courses = Course::leftJoin('demandes','demandes.id','courses.demande_id')

                                        ->where('chauffeur_id',$user_id);

        }else{
            $user_id = Session::get('authUser')->id;
            $demandes = Demande::where('user_id',$user_id);
         
            $demandes_validees = $demandes->where('is_validated',1)->get();
            $courses = Course::leftJoin('demandes','demandes.id','courses.demande_id')  
                                ->where('demandes.user_id',$user_id)
                                ->where('chauffeur_id',$user_id);
              
        }
                                */
        $id = Session::get('authUser')->id;
        $demandes = Demande::where('user_id',$id)->get();
        foreach($demandes as $demande){
            $demande_id[] = $demande->id;
        }

        $demandes_traitees = Demande::where('user_id',$id)->where('status',1)->get();
        $demandes_en_attente =Demande::where('user_id',$id)->where('status',0)->get();
        $demandes_rejetees = Demande::where('user_id',$id)->where('status',2)->get();
        $demandes_recentes = Demande::where('user_id',$id)->latest()->take(3)->get();
        
       
        
        $courses_en_attente = DB::table('courses')->whereIn('demande_id', $demande_id)->where('status','en_attente')->get();
        
       // $courses_en_cours = $courses->where('demandes.status',0) ->get();
        //$courses_terminees = $courses->where('demandes.status',1)->get();
        
        
        return view('dashboard', compact('demandes_traitees','demandes_en_attente','courses_en_attente',/*'courses_en_cours','courses_terminees',*/'demandes_rejetees','demandes','demandes_recentes'));

    }
}
