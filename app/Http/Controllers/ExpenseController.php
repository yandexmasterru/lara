<?php

namespace App\Http\Controllers;

use App\Expense;
use Validator;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function showIndex()
    {
       return view('expense.home');
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
    
    public function showList()
    {
        $data = [];
        return view('expense.add', $data);
    }
}
