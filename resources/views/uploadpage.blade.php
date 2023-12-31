<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
      
    </head>
   
    <div class="body">
        <form  action="{{route('upload-file')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group form-float">
                <div class="form-line">
                    <input type="file" class="form-control" name="files[]" required multiple>
                    <label class="form-label">Upload files</label>
                </div>
        </div>
            <button class="btn btn-primary waves-effect" type="submit">Upload</button>
        </form>
    </div>
    </body>
</html>
