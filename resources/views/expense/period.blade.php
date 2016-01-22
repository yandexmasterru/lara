@extends('layouts.master')

@section('title', 'Choose period')

@section('content')
    <h3 class="text-center">Choose Period</h3>
    <a class="block button button-primary" href="{{route('list-expenses', ["period" => 'week'])}}">Week</a></li>
    <a class="block button button-primary" href="{{route('list-expenses', ["period" => 'month'])}}">Month</a></li>
    <a class="block button button-primary" href="{{route('list-expenses', ["period" => 'year'])}}">Year</a></li>
    <a href="{{route('home')}}" class="button block">Back</a>
@endsection

