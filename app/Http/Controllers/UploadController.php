<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleService;

class UploadController extends Controller
{
    //
    public function index(GoogleService $googleService){
        $googleService->dumpData();
        return view('upload.index');
    }

    public function upload(Request $request,GoogleService $googleService){
        $this->validate($request,[
            'files'=> 'required'
        ],[
            'files.required' => 'Thiếu file để  import'
        ]);
        $fileForm = $request->only('files');
        $googleService->uploadFileGoogleDrive($fileForm['files']);
        return view('upload.index');
    }
}
