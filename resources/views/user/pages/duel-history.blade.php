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
                            <th>You</th>
                            <th>Elo</th>
                            <th>Score</th>
                            <th>Elo</th>
                            <th>Opponent</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($LastDuels as $duel) <tr>

                            @if($duel->Duel_winner->id == $user->id)


                            <td class="Username"><a href="/user/{{$duel->Duel_winner->uid}}">
                                    {{$duel->Duel_winner->name}}</a></td>
                            <td>{{$duel->Duel_winner->elo}}</td>
                            <td>{{$duel->winner_score}} - {{$duel->loser_score}}
                            </td>

                            <td>{{$duel->Duel_loser->elo}}</td>
                            <td class="Username"><a href="/user/{{$duel->Duel_loser->uid}}">
                                    {{$duel->Duel_loser->name}}</a></td>


                            @else

                            <td class="Username"><a href="/user/{{$duel->Duel_loser->uid}}">
                                    {{$duel->Duel_loser->name}}</a></td>
                            <td>{{$duel->Duel_loser->elo}}</td>
                            <td>{{$duel->loser_score}} - {{$duel->winner_score}}
                            </td>

                            <td>{{$duel->Duel_winner->elo}}</td>
                            <td class="Username"><a href="/user/{{$duel->Duel_winner->uid}}">
                                    {{$duel->Duel_winner->name}}</a></td>



                            @endif
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