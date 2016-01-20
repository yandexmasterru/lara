<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    </head>
    <body>
        <h2>Add Expense</h2>
         <form role="form" action="{{route('post-expense')}}" method="post">
             <label for="value">Value (en €) :</label> <br />
             <input name="value" id="value" value="0" min="0" step="1" type="number" value="{{ old('value') }}" /> <br />
             @if ($errors) <p class="help-block">{{ $errors->first('value') }}</p> @endif 

             
             <label for="title">Title :</label> <br />
             <input name="title" id="title" placeholder="" type="text" value="{{ old('title') }}" /> <br />
             @if ($errors) <p class="help-block">{{ $errors->first('title') }}</p> @endif 
             
             <label for="date">Date :</label> <br />
             <input name="date" id="date" type="date" value="{{ (old('date') != null) ? old('date') : date('Y-m-d') }}" /> <br />
             @if ($errors) <p class="help-block">{{ $errors->first('date') }}</p> @endif 
             
             <label for="category">Category :</label> <br />
             <select id="category" name="category">
                <option value="" selected disabled>Choose</option>
                
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ (old("category") == $category->id ? "selected":"") }}>{{ $category->title }}</option>
                @endforeach
            </select> <br /> <br />
            @if ($errors) <p class="help-block">{{ $errors->first('category') }}</p> @endif 
            
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
             
             
             <input name="submit" id="submit" type="submit" />
             <a href="{{route('home')}}">Cancel</a>
         </form>
    </body>
</html>
