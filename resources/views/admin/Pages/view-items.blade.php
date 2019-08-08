@extends('admin.layouts.navigation')




@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>


<!-- Begin Page Content -->
<div class="container-fluid">




    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        @if(\Session::has('success'))

        <div class="alert alert-success" role="alert">
            {!! \Session::get('success') !!}
        </div>
        @endif

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Items</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table data-pagination="true" data-search="true" data-toggle="table" class="table table-bordered"
                    id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Game Item ID</th>
                            <th></th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item) <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->type}}</td>
                            <td>{{$item->game_id}}</td>
                            <td><a href="/admin/item/edit/{{$item->id}}"> <button
                                        class="btn btn-success">Edit</button></a></td>
                            <td><a href="/admin/item/give/{{$item->id}}"> <button
                                        class="btn btn-primary">Give</button></a></td>
                        </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>



<script>
    function deleteTournament(btn, id)
{

    axios.post(`/admin/tournament/delete`, {
        id: id
  })
  .then(function (response) {
    console.log(response);
  })
  .catch(function (error) {
    console.log(error);
  });

  var row = btn.parentNode.parentNode;
  row.parentNode.removeChild(row);

}

function updateState(id)
{
    axios.post(`/admin/tournament/update/state`, {
        id: id
  })
  .then(function (response) {
    location.reload();
  })
  .catch(function (error) {
   
  });
}



</script>


@endsection