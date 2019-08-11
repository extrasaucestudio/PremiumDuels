@extends('user.layouts.navigation', ['user' => $user])





@section('content')


<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 @if($foreign_user->golden_account == true)
            style="color: gold!important"
            @endif class="h3 mb-0 text-gray-800">{{$foreign_user->name}}</h1>

    </div>

    <!-- Content Row -->
    <div class="row">


        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Country
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$foreign_user->Country->name ?? 'Unknown' }} &nbsp;<span
                                    class="flag-icon flag-icon-{{$foreign_user->Country->country_code ?? 'Unknown'}}"></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-globe-europe fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">ELO/Place
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$foreign_user->elo}} /
                                {{$PlaceInLeaderboard}}th</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-arrow-alt-circle-up fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Rank
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        {{$foreign_user->title->name}}
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: {{$nextRank->percent}}%"
                                            aria-valuenow="{{$nextRank->percent}}" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fist-raised fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">School
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @if($foreign_user->School != null)
                                <a href="/school/{{$foreign_user->School->id}}" style="  color:gray !important;
                                text-decoration:none;">
                                    {{$foreign_user->School->MemberToSchool->name}}
                                </a>
                                @else
                                None
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>


<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-7 col-lg-7 ml-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">ELO Graph</h6>

            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="ComparisonOfElo"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->



            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Win Ratio</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Select:</div>
                        <a class="dropdown-item" href="{{Request::url()}}">Overall</a>
                        <a class="dropdown-item" href="{{Request::url() . '?wl=me'}}">Against Me</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="WinRatioChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Win
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-warning"></i> Loss
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
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
                                <th>{{$foreign_user->name}}</th>
                                <th>Elo</th>
                                <th>Score</th>
                                <th>Elo</th>
                                <th>Opponent</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($LastDuels as $duel) <tr>

                                @if($duel->Duel_winner->id == $foreign_user->id)


                                <td class="Username"><a @if($duel->Duel_winner->golden_account == true)
                                        class="golden_account" @endif href="/user/{{$duel->Duel_winner->uid}}">
                                        {{$duel->Duel_winner->name}}</a></td>
                                <td>{{$duel->Duel_winner->elo}}</td>
                                <td>{{$duel->winner_score}} - {{$duel->loser_score}}
                                </td>

                                <td>{{$duel->Duel_loser->elo}}</td>
                                <td class="Username"><a @if($duel->Duel_loser->golden_account == true)
                                        class="golden_account" @endif href="/user/{{$duel->Duel_loser->uid}}">
                                        {{$duel->Duel_loser->name}}</a></td>

                                <td>{{$duel->created_at}}</td>
                                @else

                                <td class="Username"><a @if($duel->Duel_loser->golden_account == true)
                                        class="golden_account" @endif href="/user/{{$duel->Duel_loser->uid}}">
                                        {{$duel->Duel_loser->name}}</a></td>
                                <td>{{$duel->Duel_loser->elo}}</td>
                                <td>{{$duel->loser_score}} - {{$duel->winner_score}}
                                </td>

                                <td>{{$duel->Duel_winner->elo}}</td>
                                <td class="Username"><a @if($duel->Duel_winner->golden_account == true)
                                        class="golden_account" @endif href="/user/{{$duel->Duel_winner->uid}}">
                                        {{$duel->Duel_winner->name}}</a></td>
                                <td>{{$duel->created_at}}</td>


                                @endif
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>






</div>


</div>

<style>
    .golden_account {
        font-weight: bold;
        color: gold !important;
    }
</style>

<script>
    window.onload = function() {

        var days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
var goBackDays = 7;


    var today = new Date();
    var daysSorted = [];

    for(var i = 0; i < goBackDays; i++)
    {
        var newDate = new Date(today.setDate(today.getDate() - 1));
        daysSorted.push(days[newDate.getDay()]);
    }




   
        new Chart(document.getElementById("ComparisonOfElo"), {
  type: 'line',
  data: {
    labels: [
            daysSorted[6],
            daysSorted[5],
            daysSorted[4],
            daysSorted[3],
            daysSorted[2],
            daysSorted[1],
            'Now'

            
        ],
    datasets: [{ 
        data: [@for ($i = -6; $i < 0; $i++)
{!! $user->EloHistory[$i]->elo ?? 1000 !!},
@endfor {!! $user->elo !!}],
        label: "You",
        borderColor: "#3e95cd",
        fill: false
      }, { 
        data: [@for ($i = -6; $i < 0; $i++)
{!! $foreign_user->EloHistory[$i]->elo ?? 1000 !!},
@endfor {!! $foreign_user->elo !!}],
        label: "{{$foreign_user->name}}",
        borderColor: "#8e5ea2",
        fill: false
      }
    ]
  },
  options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
        },
        scales: {
            xAxes: [
                {
                    time: {
                        unit: "date"
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                        
                    }
                }
            ],
            yAxes: [
                {
                    ticks: {
                        precision:0,
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return number_format(value) + " ELO";
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }
            ]
        },
        legend: {
            display: false
        },
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: "#6e707e",
            titleFontSize: 14,
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: "index",
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel =
                        chart.datasets[tooltipItem.datasetIndex].label || "";
                    return (
                        datasetLabel + ": " + number_format(tooltipItem.yLabel)
                    );
                }
            }
        }
    }
});

////////// WinRatio Chart
var ctx = document.getElementById("WinRatioChart");

var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Win", "Loss"],
    datasets: [{
        data: [{!! $DuelWL->wins !!},{!! $DuelWL->loses !!}],
      backgroundColor: ['green', 'orange'],
      hoverBackgroundColor: ['green', 'orange'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

 
            }
        
</script>



@endsection