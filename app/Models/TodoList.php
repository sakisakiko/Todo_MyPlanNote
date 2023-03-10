<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;
    
    // リレーション 
        // 小目標（todo_list）は一つの大目標（todo)を持つ
      public function todo()
      {
        return $this->belongsTo('App\Models\Todo');
      }
    // リレーション 
}
