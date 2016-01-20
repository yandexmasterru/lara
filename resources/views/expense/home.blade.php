<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    </head>
    <body>
       <h2>Mes Depenses</h2>
       <ul>
           <li><a href="{{route('add-expense')}}">Add Expense</a></li>
           <li><a href="{{route('period')}}">View Expenses</a></li>
           <li><a href="#0">Edit Categories</a></li>
       </ul>
       
       @if (Session::has('message'))
            <p>{!! session('message') !!}</p>
       @endif
    </body>
</html>
