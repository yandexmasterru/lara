<?php

namespace App\Http\Controllers;

use App\Expense;
use Carbon\Carbon;
use Validator;
use DateTime;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function showIndex()
    {
       return view('expense.home');
    }
    
    public function showPeriod()
    {
        return view('expense.period');
    }
    
    public function showList($period)
    {
        if($period == 'week') {
            $expenses = Expense::orderBy('date', 'DESC')
                ->whereBetween('date', [
                    Carbon::today()->subWeek()->toDateString(), 
                    Carbon::today()->toDateString()
                ])
                ->get();
        } elseif($period == 'month') {
            $expenses = Expense::orderBy('date', 'DESC')
                ->whereBetween('date', [
                    Carbon::today()->subMonth()->toDateString(), 
                    Carbon::today()->toDateString()
                ])
                ->get(); 
        } elseif($period == 'year') {
            $expenses = Expense::orderBy('date', 'DESC')
                ->whereBetween('date', [
                    Carbon::today()->subYear()->toDateString(), 
                    Carbon::today()->toDateString()
                ])
                ->get(); 
        } else {
           $expenses = Expense::orderBy('date', 'DESC')
                ->where('date', '>=', new DateTime('-1 years'))
                ->get();  
        }
        
        
        $data = [
            "expenses" => $expenses,
        ];
        
        return view('expense.list', $data);
    }
    
    public function showAdd()
    {
        $data = [
            "categories" => Category::all(),
        ];
        
        return view('expense.add', $data);
    }
    
    public function postAdd(Request $request)
    {
        // Validation
        $v = Validator::make($request->all(), [
            'title' => 'required|min:1',
            'category' => 'required|numeric|exists:categories,id',
            'value' => 'required|numeric',
            'date' => 'required|date'
        ]);
    
        if ($v->fails())
        {   
             return redirect()->back()->withErrors($v->errors())->withInput();
        }
        
        
        // Save BDD
        $expense = new Expense;
        $expense->title = $request->input('title');
        $expense->category_id = $request->input('category');
        $expense->value = $request->input('value');
        $expense->date = $request->input('date');
        $expense->save();
        
        
        // Redirect
        return redirect('/')->with('message', 'Expense added.');
        
    }
    
}
