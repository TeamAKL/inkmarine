<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//         $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getalluser(Request $req)
    {
       $users = User::orderBy('created_at', $req->dir)->paginate($req->length);
       if(!empty($req->search)) {
           $search = $req->search;
           $query = User::where(function($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
           });
           $users = $query->paginate($req->length);
       }

        return new DataTableCollectionResource($users);
    }

    public function saveFormOne(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'crewcode' => 'required',
            'name' => 'required',
            'nationality' => 'required',
            'dob' => 'required',
            'pob' => 'required',
            'edulevel' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }
        return response()->json(["message" => "success"], 200);
    }

    public function imageUpload(Request $req)
    {
        $image = $req->image;
        $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        $filePath = 'certificate_'.$name;
        $exists = Storage::disk('ftp')->exists($filePath);
        if($exists)
            Storage::disk('ftp')->delete($filePath);
        $files = Storage::disk('ftp')->put($filePath, file_get_contents($image));
        $file_store_path = Storage::disk('ftp')->url($filePath);
        return response()->json(['url' => $file_store_path], 200);
        // certificate_1600885659.png
    }

    // public function imageUploadEdit(Request $req)
    // {

    // }
}
