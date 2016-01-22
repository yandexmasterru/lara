<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    </head>
    <body>
        <a href="{{route('home')}}">Home</a>
        <h2>Budgets</h2>
        @foreach ($budgets as $budget)
            
            {{$budget['title']}} 
            <span style="border: 5px solid {{$budget['color']}}">({{$budget['percent']}} %)</span>
            <br />
            {{$budget['value']}}
            / 
            {{$budget['budget']}} € <br />
            =========================
            <br />
            <br />
        @endforeach
        <h2>Expenses ({{$total}}€)</h2>
        @foreach ($expenses as $expense)
            {{$expense->title}} - {{$expense->value}} € <br /> 
            {{$expense->date}} - {{$expense->category->title}} <br />
            =========================
            <br />
            <br />
        @endforeach
    </body>
</html>