<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expenses';
    
    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }
}
