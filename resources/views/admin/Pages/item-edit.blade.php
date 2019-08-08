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



    @if(\Session::has('success'))

    <div class="alert alert-success" role="alert">
        {!! \Session::get('success') !!}
    </div>
    @endif

    <h1 style="text-align: center">Create Item</h1><br>




    <div class="row">
        <div class="col-xl-8 col-md-6 mb-4 MyForm">
            <form method="post" action="{{route('item-edit')}}" enctype="multipart/form-data">
                @csrf
                <label>Item Name</label>
                <input type="text" name="name" value="{{$item->name}}" class="form-control" placeholder="Great Helmet">
                <br>
                <label>Type</label>
                <br>
                <select value="{{$item->type}}" name="type" class="form-control">
                    <option value="helmet">Helmet</option>
                    <option value="body">Armor</option>
                    <option value="gloves">Globes</option>
                    <option value="boots">Boots</option>
                    <option value="weapon">Weapon</option>
                </select>
                <br>
                <label>Item id in game</label>
                <input min="0" value="{{$item->game_id}}" type="number" name="game_id" class="form-control">
                <br>
                <input type="hidden" name="id" value="{{$item->id}}">
                <label>Image</label>
                <input type="file" name="image">
                <br>
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