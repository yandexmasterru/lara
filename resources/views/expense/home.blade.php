@extends('layouts.master')

@section('title', 'Home')

@section('content')
   <!--<h3 class="text-center">Mes Depenses</h3>-->
    @if (Session::has('message'))
        <p class="info-success button block">{!! session('message') !!}</p>
    @endif
   <a class="block button button-primary" href="{{route('add-expense')}}">Add Expense</a>
   <a class="block button button-primary" href="{{route('period')}}">View Expenses</a>
   <a class="block button button-primary" href="#0">Edit Categories</a>
  
@endsection

