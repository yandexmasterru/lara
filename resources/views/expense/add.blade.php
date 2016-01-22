@extends('layouts.master')

@section('title', 'Add Expense')

@section('content')
    <h3 class="text-center">Add Expense</h3>
    <form role="form" action="{{route('post-expense')}}" method="post">
        <label for="value">Value (en €) :</label> 
        <input class="block" name="value" id="value" value="0" min="0" step="1" type="number" value="{{ old('value') }}" />
        @if ($errors) <p class="help-block">{{ $errors->first('value') }}</p> @endif 
        
        
        <label for="title">Title :</label> 
        <input name="title" id="title" placeholder="" type="text" value="{{ old('title') }}" /> 
        @if ($errors) <p class="help-block">{{ $errors->first('title') }}</p> @endif 
        
        <label for="date">Date (format YYYY-MM-DD) :</label> 
        <input name="date" id="date" type="date" value="{{ (old('date') != null) ? old('date') : date('Y-m-d') }}" /> 
        @if ($errors) <p class="help-block">{{ $errors->first('date') }}</p> @endif 
        
        <label for="category">Category :</label> 
        <select id="category" name="category">
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
