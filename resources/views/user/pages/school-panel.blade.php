@extends('user.layouts.navigation', ['user' => $user])



@section('content')
<!DOCTYPE html>
<html lang="en">

<head>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
</head>

<body>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    @if(\Session::has('error'))

    <div class="alert alert-warning" role="alert">
        {!! \Session::get('error') !!}
    </div>
    @endif

    @if(\Session::has('success'))

    <div class="alert alert-success" role="alert">
        {!! \Session::get('success') !!}
    </div>
    @endif

    <h1 style="text-align: center">School Settings</h1><br>




    <div class="row">
        <div class="col-xl-8 col-md-6 mb-4 MyForm">
            <form method="post" enctype="multipart/form-data">
                @csrf
                <label>School Title</label>

                <select class="form-control" name="schoolTitle_id">
                    @foreach ($titles as $title)
                    <option value="{{$title->id}}">{{$title->SpecialTitleData->name}}</option>
                    @endforeach
                </select>

                <br>

                <textarea id="summernote" name="body"></textarea>
                <br>
                <input id="button" type="submit" value="Edit" class="btn btn-success">
            </form>

        </div>
    </div>
</body>


<script>
    window.onload = function() {
    
            $('#summernote').summernote({
      height: 300,                 // set editor height
      minHeight: null,             // set minimum height of editor
      maxHeight: null,             // set maximum height of editor
      focus: true                  // set focus to editable area after initializing summernote
    });

    $('#summernote').summernote('editor.pasteHTML', '{!! $school->body !!}');
            }
</script>

<style>
    .MyForm {
        float: none;
        margin: 0 auto;

    }
</style>

</html>
@endsection