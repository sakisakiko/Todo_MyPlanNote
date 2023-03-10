<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    
    // リレーション
      // 一つのカテゴリーはいくつかの大目標（todo)を持つことができる
      public function todos()
      {
          return $this->hasMany('APP\Todos');
      }
    // リレーション ここまで
    
}
