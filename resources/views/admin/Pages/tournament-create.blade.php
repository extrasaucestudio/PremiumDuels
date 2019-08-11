@extends('admin.layouts.navigation')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Premium Duels</title>
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



    @if(\Session::has('success'))

    <div class="alert alert-success" role="alert">
        {!! \Session::get('success') !!}
    </div>
    @endif

    <h1 style="text-align: center">New Tournament</h1><br>




    <div class="row">
        <div class="col-xl-8 col-md-6 mb-4 MyForm">
            <form method="post" enctype="multipart/form-data">
                @csrf
                <label>Title</label>
                <input type="text" name="title" class="form-control" placeholder="Super Mega Tournament">
                <br>

                <label>Min. Elo</label>
                <input min="0" max="10000" value="0" type="number" name="minElo" class="form-control" readonly>
                <label>Max. Elo</label>
                <input min="0" max="10000" value="0" type="number" name="maxElo" class="form-control" readonly>
                <label>Price</label>
                <input min="0" max="10000" value="0" type="number" name="price" class="form-control" readonly>
                <label>Image</label>

                <br>
                <textarea id="summernote" name="body"></textarea>
                <br>

                <input id="button" type="submit" value="Create" class="btn btn-success">
                <input type="file" name="image">
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
document.getElementById("#summernote").click();
        }
</script>



</html>
@endsection

<style>
    .MyForm {
        float: none;
        margin: 0 auto;

    }
</style>