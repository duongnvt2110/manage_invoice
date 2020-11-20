<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleService;

class UploadController extends Controller
{
    //
    public function index(){
        return view('upload.index');
    }

    public function upload(Request $request,GoogleService $GoogleService){
        $this->validate($request,[
            'files'=> 'required'
        ],[
            'files.required' => 'Thiếu file để  import'
        ]);
        $fileForm = $request->only('files');
        $GoogleService->uploadFileGoogleDrive($fileForm['files']);
        return view('upload.index');
    }
}
