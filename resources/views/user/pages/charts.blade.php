@extends('user.layouts.navigation')





@section('content')


<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Best Countries</h6>

            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="CountriesGraph"></canvas>
                </div>
            </div>
        </div>
    </div>


</div>

<script>
    window.onload = function() {
        var canvas = document.getElementById('CountriesGraph');
new Chart(canvas, {
  type: 'line',
  data: {
    labels: ['1', '2', '3', '4', '5'],
    datasets: [{
      label: 'A',
      yAxisID: 'A',
      data: [100, 96, 84, 76, 69]
    }, {
      label: 'B',
      yAxisID: 'B',
      data: [1, 1, 1, 1, 0]
    }]
  },
  options: {
    scales: {
      yAxes: [{
        id: 'A',
        type: 'linear',
        position: 'left',
      }, {
        id: 'B',
        type: 'linear',
        position: 'right',
        ticks: {
          max: 1,
          min: 0
        }
      }]
    }
  }
});
       }

</script>



@endsection