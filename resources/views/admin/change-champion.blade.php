@extends('admin.layouts.navigation', ['user' => $user])


@section('content')

<div class="row">


    <div class="col-xl-4 col-md-6 mb-4 MyForm">

        <h1 style="text-align: center">Change Champion</h1><br>


        @if (\Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {!! \Session::get('error') !!}
        </div>

        @elseif(\Session::has('success'))

        <div class="alert alert-success" role="alert">
            {!! \Session::get('success') !!}
        </div>
        @endif

        <form action="/admin/title/champion/switch" method="POST">
            @csrf
            <div class="form-group">
                <label>New Champion UID</label>
                <input type="number" class="form-control" name="uid">
            </div>
         
            <input id="button" type="submit" value="Save" class="btn btn-success">
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