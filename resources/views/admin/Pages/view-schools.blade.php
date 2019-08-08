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
            <h6 class="m-0 font-weight-bold text-primary">Schools</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table data-pagination="true" data-search="true" data-toggle="table" class="table table-bordered"
                    id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Owner</th>
                            <th>Capacity</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schools as $school) <tr>
                            <td>{{$school->name}}</td>
                            <td><a href="/user/{{$school->SchoolOwner->uid}}"> {{$school->SchoolOwner->name}}</a></td>
                            <td>{{$school->capacity}}</td>

                            <td><a href="/admin/school/edit/{{$school->id}}"> <button
                                        class="btn btn-success">Edit</button></a></td>

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






@endsection