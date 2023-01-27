<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Novo beneficitário</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://use.fontawesome.com/1542acce5b.js"></script>
</head>
<body>
    <div id="app">
        <p-costumers-view data="{{ json_encode($personsData) }}" ></p-costumers-view>
    </div>
</body>
<script src="{{ mix('js/app.js') }}"></script>
</html>