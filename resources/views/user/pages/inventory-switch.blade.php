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

    <h1 style="text-align: center">Switch Inventory</h1><br>




    <div class="row">
        <div class="col-xl-8 col-md-6 mb-4 MyForm">
            <form method="post" action="/user/inventory/switch" enctype="multipart/form-data">
                @csrf


                <label>Helmet</label>
                <select class="form-control" name="helmet" id="helmet" onchange="this.form.submit()">
                    <option value="none">Default</option>
                    @foreach ($user->User_Helmets as $item)

                    <option value="{{$item->id}}">{{$item->itemData->name}}</option>
                    @endforeach
                </select>





                <label>Armor</label>
                <select class="form-control" name="armor" id="armor" onchange="this.form.submit()">
                    <option value="none">Default</option>
                    @foreach ($user->User_Armors as $item)

                    <option value="{{$item->id}}">{{$item->itemData->name}}</option>
                    @endforeach
                </select>





                <label>Boots</label>
                <select class="form-control" name="boots" id="boots" onchange="this.form.submit()">
                    <option value="none">Default</option>
                    @foreach ($user->User_Boots as $item)

                    <option value="{{$item->id}}">{{$item->itemData->name}}</option>
                    @endforeach
                </select>





                <label>Gloves</label>
                <select class="form-control" name="gloves" id="gloves" onchange="this.form.submit()">
                    <option value="none">Default</option>
                    @foreach ($user->User_Gloves as $item)

                    <option value="{{$item->id}}">{{$item->itemData->name}}</option>
                    @endforeach
                </select>





                <label>Weapon</label>
                <select class="form-control" name="weapon" id="weapon" onchange="this.form.submit()">
                    <option value="none">Default</option>
                    @foreach ($user->User_Weapons as $item)

                    <option value="{{$item->id}}">{{$item->itemData->name}}</option>
                    @endforeach
                </select>
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


<script>
    SelectElement();
    
    function SelectElement()
    {    

        
        valueToSelect = @if($user->helmet == null) null; @else {{$user->helmet}}; @endif
        id = "helmet";
        console.log(valueToSelect)
        if(valueToSelect == null) valueToSelect = 'none';
        var element = document.getElementById(id);
        element.value = valueToSelect;


        valueToSelect = @if($user->armor == null) null; @else {{$user->armor}} ;@endif
        id = "armor";

        if(valueToSelect == null) valueToSelect = 'none';
        var element = document.getElementById(id);
        element.value = valueToSelect;


        valueToSelect = @if($user->gloves == null) null; @else {{$user->gloves}}; @endif
        id = "gloves";
        
        if(valueToSelect == null) valueToSelect = 'none';
        var element = document.getElementById(id);
        element.value = valueToSelect;


        valueToSelect = @if($user->boots == null) null; @else {{$user->boots}}; @endif
        id = "boots";
       
        if(valueToSelect == null) valueToSelect = 'none';
        var element = document.getElementById(id);
        element.value = valueToSelect;


        valueToSelect = @if($user->weapon == null) null; @else {{$user->weapon}}; @endif
        id = "weapon";
    
        if(valueToSelect == null) valueToSelect = 'none';
        var element = document.getElementById(id);
        element.value = valueToSelect;

    }
    
</script>



</html>
@endsection