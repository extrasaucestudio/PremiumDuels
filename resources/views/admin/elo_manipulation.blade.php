@extends('admin.layouts.navigation', ['user' => $user])


@section('content')

<div class="row">


    <div class="col-xl-4 col-md-6 mb-4 MyForm">

        <h1 style="text-align: center">Elo Rating</h1><br>


        @if (\Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {!! \Session::get('error') !!}
        </div>

        @elseif(\Session::has('success'))

        <div class="alert alert-success" role="alert">
            {!! \Session::get('success') !!}
        </div>
        @endif

        <form action="{{route('elo_edit_api')}}">
            <div class="form-group">
                <label>User UID</label>
                <input type="number" class="form-control" name="uid">
            </div>
            <div class="form-group">
                <label>Ammount</label>
                <input id="eloInput" id="eloInt" min="1" max="1000" value="1" type="number" class="form-control"
                    name="value">
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Type of Action</label>
                <select name="action_type" class="form-control">
                    <option value="add">Add</option>
                    <option value="substract">Substract</option>
                </select>
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