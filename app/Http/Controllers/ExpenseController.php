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
        $today = Carbon::today();
        $today_day_week = $today->dayOfWeek;
        $today_day_month = $today->day;
        $today_day_year = $today->dayOfYear;
        
        $date_today = Carbon::today()->toDateString();
        $date_week = Carbon::today()->subDays($today_day_week)->addDay()->toDateString();
        $date_month = Carbon::today()->subDays($today_day_month)->addDay()->toDateString();
        $date_year = Carbon::today()->subDays($today_day_year)->toDateString();

        if($period == 'week') {
            $expenses = Expense::orderBy('date', 'DESC')
                ->whereBetween('date', [
                    $date_week, 
                    $date_today
                ])->get();
        } elseif($period == 'month') {
            $expenses = Expense::orderBy('date', 'DESC')
                ->whereBetween('date', [
                    $date_month, 
                    $date_today
                ])->get(); 
        } elseif($period == 'year') {
            $expenses = Expense::orderBy('date', 'DESC')
                ->whereBetween('date', [
                    $date_year, 
                    $date_today
                ])->get(); 
        } else {
           $expenses = Expense::orderBy('date', 'DESC')
                ->whereBetween('date', [
                    $date_year, 
                    $date_today
                ])->get();  
        }
        
        
        $expensesByBudget = $expenses->groupBy('category_id');
        $categories = Category::where('budget', '>', '0')->get();
        $expensesByBudget = $expensesByBudget->toArray();
        $categories = $categories->groupBy('id')->toArray();
        $budgetsFormat = [];
        
        
        
        foreach($categories as $category) {
            if(isset($expensesByBudget[ $category[0]['id'] ])) {
                $title = $category[0]['title'];
                $budget = $this->budgetAjust($category[0]['budget'], $period);
                $amount = 0;
                foreach($expensesByBudget[ $category[0]['id'] ] as $expense) {
                    $amount += $expense['amount'];
                }
                $percent = $this->toPercent($amount, $budget);
                $color = $this->budgetColor($percent);
                array_push($budgetsFormat, [
                    "title" => $title,
                    "budget" => $budget,
                    "amount" => $amount,
                    "percent" => $percent,
                    "color" => $color
                ]);
            }
        }
        
        
        $data = [
            "expenses"  => $expenses,
            "period"    => $period,
            "budgets"   => $budgetsFormat,
            "total"     => $expenses->sum('amount')
        ];
        
        return view('expense.list', $data);
    }
    
    private function budgetAjust($amount, $period) {
        if($period == 'week') {
            return round($amount / 4);
        } elseif($period == 'month') {
            return $amount;
        } elseif($period == 'year') {
            return round($amount * 12);
        } else {
            return round($amount * 12);
        }
    }
    
    private function toPercent($a, $b) {
        return round((100 * $a) / $b);
    }
    
    private function budgetColor($amount) {
        if($amount < 25) {
            return '#41A85F'; // GREEN COLOR
        } elseif ($amount >= 25 && $amount <= 50) {
            return '#FAC51C'; // YELLOW COLOR
        } elseif ($amount >= 50 && $amount <= 75) {
            return '#F37934'; // ORANGE COLOR
        } else {
            return '#D14841'; // RED COLOR
        }
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
            'amount' => 'required|numeric',
            'date' => 'required|date|before:tomorrow'
        ]);
    
        if ($v->fails())
        {   
             return redirect()->back()->withErrors($v->errors())->withInput();
        }
        
        
        // Save BDD
        $expense = new Expense;
        $expense->title = $request->input('title');
        $expense->category_id = $request->input('category');
        $expense->amount = $request->input('amount');
        $expense->date = $request->input('date');
        $expense->save();
        
        
        // Redirect
        return redirect('/')->with('message', 'Expense added');
        
    }
    
}
