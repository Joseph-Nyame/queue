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
        
        $allhashedcontents = filehash::all();
        $fileExists = false; // Initialize a flag variable to check if file exists
        
        foreach ($request->file('files') as $file) {
            $fileContent = file_get_contents($file->getRealPath());
            $newhashedContent = md5($fileContent);
            
            foreach ($allhashedcontents as $hashedfile) {
                if ($hashedfile->hash == $newhashedContent) {
                    $fileExists = true; // Set the flag to true if the file exists
                    break; // Exit the inner loop early since we found a match
                }
            }
            
            if (!$fileExists) {
                // Create a new filehash entry if it doesn't exist
                filehash::create(['hash' => $newhashedContent]);
            }
        }
        
        if ($fileExists) {
            return 'file exists';
        } else {
            foreach ($request->file('files') as $file) {
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;    
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
            }
       
           
        }
        
        
       
        
    

    }
}
