@extends('admin.layouts.navigation', ['user' => $user])


@section('content')

<div class="row">


    <div class="col-xl-4 col-md-6 mb-4 MyForm">

        <h1 style="text-align: center">Give</h1><br>


        @if (\Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {!! \Session::get('error') !!}
        </div>

        @elseif(\Session::has('success'))

        <div class="alert alert-success" role="alert">
            {!! \Session::get('success') !!}
        </div>
        @endif

        <form method="post" action="{{route('give-title')}}">
            @csrf
            <div class="form-group">


                <label>User UID</label>
                <input type="number" class="form-control" name="user_uid">
                <label>Title</label>
                <select class="form-control" name="title_id" id="exampleFormControlSelect1">
                    @foreach ($titles as $title)
                    <option value="{{$title->id}}">{{$title->name}}</option>
                    @endforeach


                </select>


            </div>



            <input id="button" type="submit" value="Confirm" class="btn btn-success">
        </form>

    </div>
</div>
@endsection

<style>
    .MyForm {
        float: none;
        margin: 0 auto;
    }
</style>