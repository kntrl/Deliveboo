@extends('layouts.app')

@section('content')

<div class="container pt-4">
    @if (!isset($monthlyStatsForYears))
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Ops..</h5>
          </div>
          <div class="card-body">
            {{$message}}
          </div>
        </div>
    @else
    <div class=" mt-4 col-md-12 d-flex flex-column align-items-center">
        <h1>Vendite mensili per anno</h1>
        <select name="year" id="sale-year">
            @foreach ($monthlyStatsForYears as $key=>$value)
                <option {{$loop->first ? 'id="first"' : '' }} value="{{$key}}">{{$key}}</option>
            @endforeach
        </select>
        <div style="width: 600px;">
            <canvas id="myChart"></canvas>
        </div>        
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js" integrity="sha512-5vwN8yor2fFT9pgPS9p9R7AszYaNn0LkQElTXIsZFCL7ucT8zDCAqlQXDdaqgA1mZP47hdvztBMsIoFxq/FyyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    const salesData = {!!json_encode($monthlyStatsForYears)!!};
    console.log(salesData);
    const yearSelect = document.getElementById('sale-year');
    let selectedYear = yearSelect.value;
    yearSelect.addEventListener('change',function(){
        selectedYear = this.value;
        removeData(myChart);
        addData(myChart,salesData[selectedYear].labels,salesData[selectedYear].data)
    });
    
    let ctx = document.getElementById('myChart');
    let myChart = new Chart(ctx, {
        type: 'bar',
        options: {
            indexAxis: 'x',
            },
            data: {
            labels: salesData[selectedYear].labels,
            datasets: [{
                label: 'Titolo',
                data: salesData[selectedYear].data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
    });
    console.log(myChart.data);
    
    //standard chart.js function add data
    function addData(chart, label, data) {
    label.forEach((newLabel) => chart.data.labels.push(newLabel));
    
    data.forEach((newData) => chart.data.datasets[0].data.push(newData));
    chart.update();
    }
    //standard chart.js function to remove data
    function removeData(chart) {
        chart.data.labels= [];
        chart.data.datasets[0].data=[];
        chart.update();
    }
</script>
@endif

@endsection