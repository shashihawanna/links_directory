<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Card</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div class="container">
        # Hello {{ $content['first_name'] }},
        <br><br>
        <div>
        Your link added successfully.Link details as below.<br>
        Link =>{{ $content['url'] }} <br>
        Title =>  {{  $content['title'] }}<br>
        Description => {{  $content['description'] }}<br>
        </div>
        <br>
        <div>
        Thanks,<br>
        {{ config('app.name') }} Team.
        </div>
    </div>
</body>

</html>