@extends('user.layouts.navigation', ['user' => $user])

@section('content')
<!DOCTYPE html>
<html lang="en">


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

    <h1 style="text-align: center">Create School</h1><br>




    <div class="row">
        <div class="col-xl-8 col-md-6 mb-4 MyForm">
            <form method="post" action="{{route('create-school-user')}}" enctype="multipart/form-data">
                @csrf
                <label>School Name</label>
                <input type="text" name="name" maxlength="30" class="form-control" placeholder="Pro Elo School 9000">
                <br>
                <label>Gloves</label>
                <select class="form-control" name="gloves_id">
                    @foreach ($gloves as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach

                </select>
                <br>
                <label>Boots</label>
                <select class="form-control" name="boots_id">
                    @foreach ($boots as $item_)
                    <option value="{{$item_->id}}">{{$item_->name}}</option>
                    @endforeach

                </select>
                <br>
                <input id="button" type="submit" value="Create (15000)" class="btn btn-success">
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