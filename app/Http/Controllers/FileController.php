<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\filerecord;
use App\Models\filehash;
use App\Jobs\SaveFile;


class FileController extends Controller
{
    public function index(Request $request){
        return view('uploadpage');
    }
    public function upload(Request $request){
        foreach ($request->file('files') as $file) {

            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $fileContent = file_get_contents($file->getRealPath());
            $allhashedcontents = filehash::all();
    
            $newhashedContent = md5($fileContent);
       
            foreach ($allhashedcontents as $hashedfile) {
            
                if($hashedfile == $newhashedContent){
                   
                    return 'file exists';
                }
                else{
                    
                    filehash::create(['hash'=>$newhashedContent]);
                    
                }
            }
            
                $fileData[] = [
                    'original_name' => $originalName,
                    'filename' => $filename,
                    'extension' => $extension,
                ];
               
                $filenames[] = $originalName;
                if (!empty($fileData)) {
   
                    SaveFile::dispatch($fileData);
             
                     return 'success';
                 }
                  else {
                     return 'No files to upload.';
                 }
               
        
               
        }
    
    

    }
}
