@extends('admin.layouts.navigation')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Premium Duels</title>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
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


    @if (\Session::has('error'))
    <div class="alert alert-danger" role="alert">
        {!! \Session::get('error') !!}
    </div>

    @elseif(\Session::has('success'))

    <div class="alert alert-success" role="alert">
        {!! \Session::get('success') !!}
    </div>
    @endif

    <h1 style="text-align: center">Create School</h1><br>




    <div class="row">
        <div class="col-xl-8 col-md-6 mb-4 MyForm">
            <form method="post" action="{{route('school-create')}}" enctype="multipart/form-data">
                @csrf
                <label>School Name</label>
                <input type="text" name="name" class="form-control" placeholder="Best School !!!!">
                <br>
                <label>Owner ID</label>
                <input type="number" name="uid" class="form-control">
                <br>
                <input id="button" type="submit" value="Create" class="btn btn-success">
            </form>

        </div>
    </div>
</body>


<style>
    .MyForm {
        float: none;
        margin: 0 auto;

    }
</style>

</html>
@endsection