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
        $users = User::orderBy('created_at', $req->dir)->paginate(2);
        if(!empty($req->search)) {
            $search = $req->search;
            $query = User::where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
            });
            // $users = $query->paginate($req->length);
            $users = $query->paginate(2);
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
            $url = $this->upload($req->image, $req->folder);
            return response()->json(['url' => $url], 200);
        }

        public function imageUploadEdit(Request $req)
        {
            $oldFile = str_replace('/images/', '', parse_url($req->oldImage, PHP_URL_PATH));
            Storage::disk('public')->delete($oldFile);
            $url = $this->upload($req->image, $req->folder);
            return response()->json(['url' => $url], 200);
        }

        public function imageDelte(Request $req)
        {
            $oldFile = str_replace('/images/', '', parse_url($req->image, PHP_URL_PATH));
            Storage::disk('public')->delete($oldFile);
        }

        public function upload($image, $folder) {
            $name = 'medicalcheckup_'.rand(1, 999).'.'.explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $filePath = $folder.$name;
            $fileContent = file_get_contents($image);
            $exists = Storage::disk('public')->exists($filePath);
            if($exists)
                Storage::disk('public')->delete($filePath);
            Storage::disk('public')->put($filePath, $fileContent);
            $url = Storage::disk('public')->url($filePath);
            return $url;
        }
    }
