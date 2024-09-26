<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;

use App\Models\UserInfo;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        if (Session::has('manager')) {
            return view('auth.register');
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'manager' => ['required', 'string', 'max:255'],

        ]);
        $response = Http::get('http://10.143.41.70:8000/promo2/odcapi/?method=getUsers');

        if ($response->successful()) {

            if (strpos($request->input("manager"), ' ') !== false) {

                $manager_tab = explode(' ', $request->manager);
                $firstname = $manager_tab[0];
                $lastname = $manager_tab[1];
                $username = $request->manager;
                $users = $response->json();
                $manager_firstname = collect($users['users'])->firstWhere('first_name', $firstname);
                $manager_lastname = collect($users['users'])->firstWhere('last_name', $lastname);
                $user_id = Session::get('userId');
                $user = collect($users['users'])->firstWhere('id', $user_id);

                if ($manager_firstname === $manager_lastname) {

                  

                    if ($manager_firstname != null) {

                        if ($user_id == $manager_firstname['id']){
                            return back()->with("message","Vous ne pouvez pas vous choisir comme manager");
                        }
                        $users = User::all()->count();

                        if ($users == 0) {
                            if ($user) {
                                User::create([
                                    'id' => $user['id'],
                                    'first_name' => $user['first_name'],
                                    'username' => $user['username'],
                                    'last_name' => $user['last_name'],
                                    'email' => $user['email'],
                                    'phone' => $user['phone'],
                                    'password' => Hash::make($request->password),
                                ]);
                                if ($manager_firstname) {
                                    UserInfo::create([
                                        'user_id' => $user_id,
                                        'email_manager' => $manager_firstname['email'],

                                    ]);
                                } else {
                                    return back()->with("message","Le manager n'existe pas ");
                                }

                                $user = User::find($user['id']);
                                $user->assignRole('admin');
                                $email = $user->email;
                                $manager = UserInfo::where('email_manager', $email)->first();
                                if ($manager != null) {
                                    Session::put('userIsManager', $manager);
                                }


                                Session::put('authUser', $user);
                                Session::forget('manager');
                                return redirect()->route('dashboard');
                            }
                        } else if ($users > 0) {

                            if ($user) {

                                User::create([
                                    'id' => $user['id'],
                                    'first_name' => $user['first_name'],
                                    'username' => $user['username'],
                                    'last_name' => $user['last_name'],
                                    'email' => $user['email'],
                                    'phone' => $user['phone'],
                                    'password' => Hash::make($request->password),
                                ]);
                                if ($manager_firstname) {
                                    UserInfo::create([
                                        'user_id' => $user_id,
                                        'email_manager' => $manager_firstname['email'],

                                    ]);
                                } else {
                                    return back()->with("message","Le manager n'existe pas ");
                                }
                                $user = User::find($user['id']);

                                $email = $user->email;
                                $manager = UserInfo::where('email_manager', $email)->first();
                                if ($manager != null) {
                                    Session::put('userIsManager', $manager);
                                }


                                Session::put('authUser', $user);
                                Session::forget('manager');

                                return redirect()->route('dashboard');
                            }
                        }
                    }
                    else{
                        return back()->with("message","Le manager n'existe pas ");
                    }
                }
            } else {
                return back()->with("message","Le manager n'existe pas ");
            }
        }

        return redirect()->route('login');
    }

    public function autocomplete(Request $request)
    {

        /*      $response = Http::get('http://10.143.41.70:8000/promo2/odcapi/?method=getUsers');
        $usernames = array_column($response['users'], 'username');
        $data = collect($usernames)
        ->where(function ($value) use ($request) {
            return stripos($value, $request->get('query')) !== false;
        })
        ->values();
       
      return response()->json($data);
      */

        $query = $request->get('query');
        $url = 'http://10.143.41.70:8000/promo2/odcapi/?method=getUserByName&name=' . $query;
        $response = Http::get($url);
        if ($response->successful()) {
            $data = $response->json('users');


            $filteredData = collect($data)
                ->where(function ($item) use ($query) {
                    return stripos($item['first_name'], $query) !== false
                        || stripos($item['last_name'], $query) !== false;
                })
                ->map(function ($item) {
                    return [
                        'name' => $item['first_name'] . ' ' . $item['last_name']
                    ];
                })
                ->toArray();

            return response()->json($filteredData);
        }
    }
}
