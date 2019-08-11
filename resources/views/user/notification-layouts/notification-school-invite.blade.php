@extends('user.layouts.navigation', ['user' => $user])





@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">



    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-9 col-lg-8 col-centered">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Notification</h6>

                </div>
                <br>
                <h3 style="text-align: center">You got invited to {{$notification->data['school_name']}} by
                    <a href="/user/{{$notification->data['user_uid']}}"> {{$notification->data['user_name']}}</a> </h3>

                <div class="col-centered form-inline">
                    <form action="/user/school/join" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success">Join</button> &nbsp;
                        <input type="hidden" name="invite_id" value="{{$notification->data['invite_id']}}">
                    </form>

                    <form action="/user/school/reject" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger">Reject</button>
                        <input type="hidden" name="invite_id" value="{{$notification->data['invite_id']}}">
                    </form>
                </div>

                <div class="card-body">




                    {{$notification->created_at}}
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<style>
    .col-centered {
        float: none;
        margin: 0 auto;
    }

    .form-inline {
        display: flex;
        flex-flow: row wrap;
        align-items: center;
    }
</style>


@endsection