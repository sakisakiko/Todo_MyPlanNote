<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    
    // リレーション 
      //一つの 大目標（todo)は一人のユーザーと紐づく
      public function user()
      {
          return $this->belongsTo('App\Models\User');
      }
      
     //一つの 大目標（todo)は一つのカテゴリと紐づく
      public function category()
      {
          return $this->belongsTo('App\Models\Category');
      }
      
    // ひとつの大目標(todo)はいくつかの小目標（todolists)を持つことができる
      public function todo_lists()
      {
        return $this->hasMany('App\Models\TodoList');
      }
    // リレーション ここまで
    
}
