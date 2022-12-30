<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar usuário</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://use.fontawesome.com/1542acce5b.js"></script>
</head>
<body>
    <div id="app">
        <p-users-edit user="{{ json_encode($userData) }}" ></p-users-edit>
    </div>
</body>
<script src="{{ mix('js/app.js') }}"></script>
</html>