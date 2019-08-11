@extends('admin.layouts.navigation')




@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">




    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Our Users Database</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table data-pagination="true" data-search="true" data-toggle="table" class="table table-bordered"
                    id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>UID</th>
                            <th>Elo</th>
                            <th>Currency</th>
                            <th>Rank</th>
                            <th>Title</th>
                            <th> Active? </th>
                            <th> Country </th>
                            <th>Registered at</th>
                            <th> Last Seen at </th>
                            <th>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users_ as $user_) <tr>
                            <td class="Username"><a href="/user/{{$user_->uid}}"> {{$user_->name}}</a></td>
                            <td>{{$user_->uid}}</td>
                            <td>{{$user_->elo}}</td>
                            <td>{{$user_->currency}}</td>
                            <td><b style="color: {{$user_->Title->color}}">{{$user_->Title->name}}</b> &nbsp <img
                                    class="rank_img_leaderboard" src="{{$user_->Title->image}}"></td>
                            <td>@if($user_->SpecialTitle != null){{$user_->SpecialTitle->SpecialTitleData->name}} @endif
                            </td>
                            <td>@if($user_->active == 1) True @else False @endif</td>
                            <td>@if($user_->country_code != null) <span
                                    class="flag-icon flag-icon-{{$user_->Country->country_code ?? 'Unknown'}}"></span>
                            </td>@endif
                            <td>{{$user_->created_at}}</td>
                            <td>{{$user_->updated_at}}</td>
                            <td><a href="/admin/school/invite?uid={{$user_->uid}}"> <button
                                        class="btn btn-primary">Invite to School</button></a></td>
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