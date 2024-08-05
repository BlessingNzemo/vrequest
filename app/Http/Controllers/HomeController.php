<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        if(Session::get('authUser')->hasRole('charroi')){
            $demandes =  Demande::where('is_validated',1);
            $demandes_validees = $demandes->get();
 
            $courses = Course::leftJoin('demandes','demandes.id','courses.demande_id')  ;
            // dd($courses);
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
       
        $demandes_traitees = $demandes->where('status',1)->get();
        $demandes_en_attente =Demande::where('status',0)->get();
       

        $courses_en_attente = $courses->where('demandes.status',0)->get();
        $courses_en_cours = $courses->where('demandes.status',0) ->get();
        $courses_terminees = $courses->where('demandes.status',1)->get();
        //dd($demandes_validees);
        
        return view('dashboard', compact('demandes_validees','demandes_traitees','demandes_en_attente','courses_en_attente','courses_en_cours','courses_terminees'));

    }
}
