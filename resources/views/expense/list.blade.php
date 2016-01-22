@extends('layouts.master')

@section('title', 'Expenses')

@section('content')
    <h3 class="text-center">{{ucfirst($period)}} Budgets</h3>
    @foreach ($budgets as $budget)
        <div class="budget">
            <strong>{{$budget['title']}}</strong>
            <span>: {{$budget['percent']}}%</span>
            <div class="progress-wrap progress">
              <div class="progress-bar progress" style="background: {{$budget['color']}}; width: {{$budget['percent']}}%;"></div>
            </div>
            {{$budget['amount']}}
            / 
            {{$budget['budget']}} € <br />
            <br />
            <br />
        </div>
    @endforeach
    
    <h3 class="text-center">{{ucfirst($period)}} Expenses : {{$total}}€</h3>
    <table class="u-full-width">
      <thead>
        <tr>
          <th>Expense</th>
          <th>Amount</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($expenses as $expense)
        <tr>
          <td>
              <strong>{{$expense->title}}</strong>
              <br /> 
              {{$expense->date}} 
              - 
              <span style="border-bottom: 2px solid {{$expense->category->color}}">{{$expense->category->title}}</span>
          </td>
          <td>{{$expense->amount}}€</td>
        </tr>
        @endforeach
      </tbody>
    </table>
     <a href="{{route('period')}}" class="button block">Back</a>
@endsection