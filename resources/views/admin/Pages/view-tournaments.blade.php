@extends('admin.layouts.navigation')




@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>


<!-- Begin Page Content -->
<div class="container-fluid">




    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tournaments</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table data-pagination="true" data-search="true" data-toggle="table" class="table table-bordered"
                    id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>State</th>
                            <th>Creator</th>
                            <th>Created at</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tournaments as $tournament) <tr>
                            <td><a href="/tournament/{{$tournament->id}}"> {{$tournament->title}}</a></td>
                            <td>@if($tournament->state == 'awaiting')
                                <button onclick="updateState({{$tournament->id}})" type="button"
                                    class="btn btn-primary">{{$tournament->state}}</button>
                                @elseif($tournament->state == 'ongoing')
                                <button onclick="updateState({{$tournament->id}})" type="button"
                                    class="btn btn-success">{{$tournament->state}}</button>
                                @else
                                <button disabled type="button" class="btn btn-danger">{{$tournament->state}}</button>
                                @endif
                            </td>
                            <td><a href="/user/{{$tournament->creator->uid}}"><b>{{$tournament->creator->name}}</b></a>
                            </td>
                            <td>{{$tournament->created_at}}</td>

                            <td><a href="/admin/tournament/edit/{{$tournament->id}}"> <button @if($tournament->state ==
                                        'finished') disabled @endif type="button"
                                        class="btn btn-success">Edit</button></a>
                                &nbsp;

                                <button disabled onclick="deleteTournament(this, {{$tournament->id}})" type="button"
                                    class="btn btn-danger">Delete</button></td>

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