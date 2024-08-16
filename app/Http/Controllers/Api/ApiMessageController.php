<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Message;
use App\Models\MessageGroupe;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApiMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'demande_id'=>'required|min:1',
        ]);

        return response()->json(MessageResource::collection($messages = Message::selectRaw('messages.*')
                                                                                ->leftJoin('message_groupes','message_groupes.id','messages.message_groupe_id')
                                                                                ->leftJoin('demandes','demandes.id','message_groupes.demande_id')
                                                                                ->where('demandes.id',$request->demande_id)
                                                                                ->get()));
    }

    public function saveLogo($file,$crypt){
        $extensions = array('jpeg','jpg','png');
        //dimensions:min_width=100,min_height=100

        $extension = $file->extension();

        $crypt_filename = sha1(md5($crypt)) ;
        $filename = $crypt_filename.'.'.$extension;
        
        $pathFile = $file->storeAs('attachment',$filename,'public');

        $url = Storage::disk('public')->url('public/logos/'.$filename);

        return $pathFile;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $req = $request->validate([
            'user_id' => 'required',
            'message_groupe_id' => 'required',
            'contenu' => 'nullable|string',
            'file' => 'nullable',
            'isVideo' => 'nullable',
            'isPicture' => 'nullable'
            // 'time'=>'required',
        ]);

        $added = false;

        try{
            //$mg = MessageGroupe::where('demande_id',$request->message_groupe_id)->first();
            $mg = MessageGroupe::firstOrCreate([
                'demande_id' => $request->message_groupe_id,
            ]);

            $message = ($request->contenu != null) ? $request->contenu : "" ;

            if($request->hasFile('file')){
                $crypt = $request->user_id.$mg->id.Str::random(3) ;

                $file = $request->file('file');
                $filepath = $this->savelogo($file,$crypt);

                $created = Message::create([
                    'user_id' => $request->user_id,
                    'message_groupe_id' => $mg->id,
                    'contenu' => $message,
                    'filepath' => $filepath, 
                    'isVideo' => (!empty($request->isVideo)) ? $request->isVideo : 0,
                    'isPicture' => (!empty($request->isPicture)) ? $request->isPicture : 0 
                ]);

            }else{
                $created = Message::create([
                    'user_id' => $request->user_id,
                    'message_groupe_id' => $mg->id,
                    'contenu' => $message,
                ]);
            }

            $added = true;
        }catch(Exception $e){
            $added = false;
            // return $e;
        }

        return response()->json([
            'added' => $added,
            'message' => $created
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $message = Message::find($id);
        return response()->json([
            'message' => $message
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}