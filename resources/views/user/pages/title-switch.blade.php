@extends('user.layouts.navigation')

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

    <h1 style="text-align: center">Switch Title</h1><br>




    <div class="row">
        <div class="col-xl-8 col-md-6 mb-4 MyForm">
            <form method="post" action="{{route('switch-title')}}" enctype="multipart/form-data">
                @csrf
                <label>Title Name</label>
                <select class="form-control" name="title" id="Titles" onchange="this.form.submit()">
                    @foreach ($user->SpecialTitles as $item)

                    <option value="{{$item->id}}">{{$item->SpecialTitleData->name}}</option>

                    @endforeach
                    <option value="none">Blank</option>
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
    SelectElement("Titles", {{$user->special_title_id}})
    
    function SelectElement(id, valueToSelect)
    {    
        if(valueToSelect == null) valueToSelect = 'none';
        var element = document.getElementById(id);
        element.value = valueToSelect;
    }
    
</script>

</html>
@endsection