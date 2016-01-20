<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    </head>
    <body>
        <h2>Expenses</h2>
        @foreach ($expenses as $expense)
            {{$expense->title}} - {{$expense->value}} € <br /> 
            {{$expense->date}} <br />
            =========================
            <br />
            <br />
        @endforeach
    </body>
</html>
