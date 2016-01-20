<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    
    public function expenses()
    {
        return $this->hasMany('App\Expense', 'category_id', 'id');
    }
}
