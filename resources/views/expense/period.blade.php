<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    </head>
    <body>
        <h2>Expenses Period</h2>
        <ul>
           <li><a href="{{route('list-expenses', ["period" => 'week'])}}">Week</a></li>
           <li><a href="{{route('list-expenses', ["period" => 'month'])}}">Month</a></li>
           <li><a href="{{route('list-expenses', ["period" => 'year'])}}">Year</a></li>
       </ul>
    </body>
</html>
