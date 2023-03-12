<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
   //categoriesテーブルから::pluckでcategory_nameとidを抽出し、$categoriesに返す関数を作る
    public function getLists()
    {
        $categories = Category::pluck('category_name', 'id');

        return $categories;
    }
    
    
    // リレーション
      // 一つのカテゴリーはいくつかの大目標（todo)を持つことができる
      public function todos()
      {
          return $this->hasMany('App\Models\Todos');
      }
    // リレーション ここまで
    
}
