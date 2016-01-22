@extends('layouts.master')

@section('title', 'Add Expense')

@section('content')
    <h3 class="text-center">Add Expense</h3>
    <form role="form" action="{{route('post-expense')}}" method="post">
        <label for="amount">Amount (en €, use point not comma) :</label> 
        <input class="block" name="amount" id="amount" min="0.01" step="0.01" type="number" placeholder="0.00" required="true" value="{{ old('amount') }}" />
        @if ($errors) <p class="help-block">{{ $errors->first('amount') }}</p> @endif 
        
        
        <label for="title">Title :</label> 
        <input name="title" id="title" placeholder="" type="text" required="true" value="{{ old('title') }}" /> 
        @if ($errors) <p class="help-block">{{ $errors->first('title') }}</p> @endif 
        
        <label for="date">Date (format YYYY-MM-DD) :</label> 
        <input name="date" id="date" type="date" required="true" value="{{ (old('date') != null) ? old('date') : date('Y-m-d') }}" /> 
        @if ($errors) <p class="help-block">{{ $errors->first('date') }}</p> @endif 
        
        <label for="category">Category :</label> 
        <select id="category" name="category" required="true">
        <option value="" selected disabled>Choose</option>
        
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ (old("category") == $category->id ? "selected":"") }}>{{ $category->title }}</option>
        @endforeach
        </select>  
        @if ($errors) <p class="help-block">{{ $errors->first('category') }}</p> @endif 
        
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        
        
        <input name="submit" class="button-primary" id="submit" type="submit" />
        <a href="{{route('home')}}" class="button block">Cancel</a>
    </form>
@endsection
