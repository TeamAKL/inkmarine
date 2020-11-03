<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Employeer;
use App\EmployeerDetail;
use Yajra\Datatables\Datatables;

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

    public function deleteUser(Request $req)
    {
        User::destroy($req->id);
        return response()->json(['message' => 'Success'], 200);
    }

    public function resetPassword(Request $req)
    {
        User::find($req->id)->update(['password' => Hash::make($req->password)]);
        return response()->json(['message' => 'Success'], 200);
    }

    public function creatUser(Request $req)
    {
        User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
        ]);

        return response()->json(['message' => 'Success'], 200);
    }

    public function getusers(Request $req) {
        $users = User::where('role_id', '!=', 1)->orderBy('created_at', 'asc')->get();

        return Datatables::of($users)
        ->addColumn('action', function($data) {
            $html = "<button class='btn btn-primary reset-btn' data-id='$data->id' data-toggle='modal' data-target='#reset-password-modal'>Reset Password</button>
                <button class='btn btn-danger delete-btn' data-id='$data->id' data-name='$data->name'>Delete</button>";
            return $html;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function getalluser(Request $req)
    {
        $employers = Employeer::with('employeer_details')->paginate($req->length);
        return new DataTableCollectionResource($employers);
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
            $name = 'inkmarine_'.rand(1, 999).'.'.explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $arr = explode(".", $name);
            $ext = $arr[1];
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
