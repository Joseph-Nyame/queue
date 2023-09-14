<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\filerecord;
use App\Models\filehash;

class SaveFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $fileData;
    /**
     * Create a new job instance.
     */
    public function __construct($fileData)
    {
        $this->fileData = $fileData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
      
        foreach ($this->fileData as $fileInfo) {
        $originalName = $fileInfo['original_name'];
        
        $filename = $fileInfo['filename'];
        
        $storagePath = storage_path('app/public'.$originalName);
    
        filerecord::create(['filename' => $filename]);
       
    }

  
    
      
        
    }
}
