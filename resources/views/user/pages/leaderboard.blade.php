@extends('user.layouts.navigation', ['user' => $user])




@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">




    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Leaderboard</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table data-pagination="true" data-search="true" data-toggle="table" class="table table-bordered"
                    id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Username</th>
                            <th></th>
                            <th>Elo Rating</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user_) <tr>
                            <td>{{$loop->index+1}}</td>
                            <td><a class="uk-link-reset" @if($user_->golden_account == true)
                                    style="color: gold!important; font-weight: 1000; text-shadow: -1px -1px 0 #000, 1px
                                    -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;"
                                    @else style="color: black!important" @endif
                                    href="/user/{{$user_->uid}}">{{$user_->name}}
                                    <span
                                        class="flag-icon flag-icon-{{$user_->Country->country_code ?? 'Unknown'}}"></span></a>
                            </td>



                            <td>@if($user_->SpecialTitle != null) <span
                                    style="color:black">{{$user_->SpecialTitle->SpecialTitleData->name}} |
                                </span>@endif<b style="color: {{$user_->Title->color}}">{{$user_->Title->name}}</b>
                                &nbsp
                                <img class="rank_img_leaderboard" src="{{$user_->Title->image}}"> </td>
                            <td>{{$user_->elo}}</td>


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