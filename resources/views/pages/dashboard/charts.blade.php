<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Charts</title>
    
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://use.fontawesome.com/1542acce5b.js"></script>
</head>
<body>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <canvas id="addressChart"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="ageChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addressData = @json($addressData);
        const ageData = @json($ageData);

        const addressCtx = document.getElementById('addressChart').getContext('2d');
        new Chart(addressCtx, {
            type: 'bar',
            data: {
                labels: addressData.map(d => d.neighborhood),
                datasets: [{
                    label: 'Endereço',
                    data: addressData.map(d => d.total),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            }
        });

        const ageCtx = document.getElementById('ageChart').getContext('2d');
        new Chart(ageCtx, {
            type: 'bar',
            data: {
                labels: ageData.map(d => d.age),
                datasets: [{
                    label: 'Idade',
                    data: ageData.map(d => d.total),
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            }
        });
    });
</script>
<script src="{{ mix('js/app.js') }}"></script>
</html>
