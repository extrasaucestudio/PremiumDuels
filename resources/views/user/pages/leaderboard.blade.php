@extends('user.layouts.navigation')




@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">




    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Duel History</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table data-pagination="true" data-search="true" data-toggle="table" class="table table-bordered"
                    id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th></th>
                            <th>Elo Rating</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user) <tr>
                            <td><a class="uk-link-reset" @if($user->golden_account == true)
                                    style="color: gold!important"
                                    @else style="color: black!important" @endif
                                    href="/user/{{$user->uid}}">{{$user->name}}
                                    <span
                                        class="flag-icon flag-icon-{{$user->Country->country_code ?? 'Unknown'}}"></span></a>
                            </td>



                            <td>@if($user->SpecialTitle != null) <span
                                    style="color:black">{{$user->SpecialTitle->SpecialTitleData->name}} |
                                </span>@endif<b style="color: {{$user->Title->color}}">{{$user->Title->name}}</b> &nbsp
                                <img class="rank_img_leaderboard" src="{{$user->Title->image}}"> </td>
                            <td>{{$user->elo}}</td>


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