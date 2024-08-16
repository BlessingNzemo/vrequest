<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\UsergetResource;
use Laravel\Sanctum\PersonalAccessToken;
use App\Http\Resources\UserManagerResource;

class AuthenticateController extends Controller
{
    //
        /**
     * @OA\Post(
     *      path="/login",
     *      operationId="loginInVrequest",
     *      tags={"User"},
     *      summary="Authentification",
     *     
     *      @OA\Parameter(
     *          name = "username",
     *          in = "query",
     *          description = "username",
     *          required = true,
     *          
     *      ),
     *      @OA\Parameter(
     *          name = "password",
     *          in = "query",
     *          description = "user password",
     *          required = true,
     *          @OA\Schema(type = "string")
     *          
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      )
     * )
     */

    public function login(Request $request){
        
        $data = [
            "username"=>$request->username,
            "password"=>$request->password
        ];
    
        
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post('http://10.143.41.70:8000/promo2/odcapi/?method=login', $data);
        if($response->successful()){
            $data = $response->json();
           
            if(User::find($data['user']['id'])){
                $user = User::where('username',$request->username)->first();
                $token=$user->createToken($request->username)->plainTextToken;
                $user->token =$token ;
                 if(UserInfo::where('user_id',$data['user']['id'])->first()){
                    return new UserManagerResource($user);
                 }
                 else{
                    return new UserResource($user);
                 }
               
                
            }
            else{
                User::create([
                    'id'=>$data['user']['id'],
                    'first_name'=>$data['user']['first_name'],
                    'username' =>$data['user']['username'],
                    'last_name'=>$data['user']['last_name'],
                    'email' => $data['user']['email'],
                    'phone'=> $data['user']['phone'],
                    'password' => Hash::make($request->password),
                   
                ]);
                
                $user = User::where('username',$request->username)->first();
                $token=$user->createToken($request->username)->plainTextToken;
                $user->token =$token ;
            
                return new UserResource($user);
    }
}
  else{
    $response = ["success"=>false,"message"=>"username or password incorrect"];
    return response()->json($response);
  }
       
    }

/**
     * @OA\Get(
     *      path="/getuser",
     *      tags={"User"},
     *      summary="Get a user",
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found"
     *      )
     *     )
     */
public function getUser(Request $request){
    $token = $request->header('Authorization');
    $token = Str::replaceFirst('Bearer ', '', $token);

    $accessToken = PersonalAccessToken::findToken($token);
    if ($accessToken) {
      
        $user = $accessToken->tokenable;
  
        return new UsergetResource($user);
    
    }
    
    else{
        return response()->json('Token invalide');
    }
 
   
   
    
}
/**
     * @OA\Post(
     *      path="/getnameuser",
     *      
     *      tags={"User"},
     *      summary="Get name User",
     *     
     *      @OA\Parameter(
     *          name = "name",
     *          in = "query",
     *          description = "name",
     *          required = true,
     *          
     *      ),
     *     
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      )
     * )
     */
public function getNameUser(Request $request){
    $request->validate([
        'name' => 'required'
    ]);

    $query = $request->name;
   
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
                return 
                   $item['first_name'] . ' ' . $item['last_name']
                ;
            })
            ->toArray();

        return response()->json($filteredData);
    }

    return response()->json(['error' => 'No users found'], 404);
}

/**
     * @OA\Post(
     *      path="/savemanager",
     *      
     *      tags={"User"},
     *      summary="Save manager",
     *     
     *      @OA\Parameter(
     *          name = "id",
     *          in = "query",
     *          description = "id",
     *          required = true,
     *          
     *      ),
     *      @OA\Parameter(
     *          name = "name",
     *          in = "query",
     *          description = "name",
     *          required = true,
     *          @OA\Schema(type = "string")
     *          
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      )
     * )
     */
  public function saveManager(Request $request){
    $request->validate([
        'id'=> 'required',
        'name' => 'required'
    ]);
    $manager_tab = explode(' ',$request->name);
    $name = $manager_tab[0];
    $url = 'http://10.143.41.70:8000/promo2/odcapi/?method=getUserByName&name=' . $name;
    $response = Http::get($url);
    $manager_response = $response->json('users');
   foreach($manager_response as $managers){
        $manager = $managers['email'];
    }
    $a = UserInfo::where('user_id',$request->id)->first();
    if(!empty($a)){
        return "Manager already exists";
    }
 
    UserInfo::create([
        "user_id"=>$request->id,
        "email_manager"=>$manager
        
    ]);
    return "Manager Saved";
  }
}