@extends('user.layouts.navigation', ['user' => $user])





@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">







    <!-- /.container-fluid -->

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$school->name}}</h1>

    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Members
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$school->Members->count()}}/{{$school->capacity}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">ELO
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$school->elo}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-arrow-alt-circle-up fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Title
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$school->SpecialTitle->name ?? 'None'}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-university fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Owner
                            </div>
                            @if($Addionaldata->GoldSchool == 0)

                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$school->SchoolOwner->name}}</div>
                            @else

                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$Addionaldata->Owner}}</div>
                            @endif
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-crown fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Members</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table data-toggle="table" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Rank</th>
                            <th>Elo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($school->Members as $member) <tr>
                            <td><a class="uk-link-reset" @if($member->User->golden_account == true)
                                    style="color: gold!important"
                                    @else style="color: black!important" @endif
                                    href="/user/{{$member->User->uid}}">{{$member->User->name}}
                                    <span
                                        class="flag-icon flag-icon-{{$member->User->Country->country_code ?? 'Unknown'}}"></span></a>
                            </td>

                            <td>@if($member->User->SpecialTitle != null) <span
                                    style="color:black">{{$member->User->SpecialTitle->SpecialTitleData->name}} |
                                </span>@endif<b
                                    style="color: {{$member->User->Title->color}}">{{$member->User->Title->name}}</b>
                                &nbsp
                                <img class="rank_img_leaderboard" src="{{$member->User->Title->image}}"> </td>
                            <td>{{$member->User->elo}}</td>

                        </tr>
                        @endforeach

                    </tbody>

                </table>
                <br>
                @if($user->School != null && $user->School->MemberToSchool->id == $school->id &&
                !$user->isChampion->count() > 0) <form action="/user/school/leave" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger">Leave</button>
                </form>

                @endif
            </div>
        </div>

    </div>

    <div class="row row justify-content-center">

        <!-- Area Chart -->
        <div class="col-xl-10 col-lg-10">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">About</h6>

                </div>

                <div class="card-body" style=" color: black;">
                    <div class="chart-area">
                        {!! $school->body !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- Content Row -->


@endsection