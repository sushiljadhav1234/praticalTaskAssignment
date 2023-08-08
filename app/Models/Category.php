<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    protected $fillable = ['name','parent_id'];

    public function childs()
    {
    	return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
    	return $this->belongsTo(Category::class, 'parent_id');
    }


    public function subcategories()
    {
        return $this->childs()->with('subcategories');
    }

    public static function tree(){
        $allCategories = Category::get();

        $rootCategories = $allCategories->whereNull('parent_id');
        
        self::formatTree($rootCategories,$allCategories);
    
        return $rootCategories;
    }

    private static function formatTree($categories,$allCategories){


        foreach($categories as $category){

            $category->subcategories = $allCategories->where('parent_id',$category->id);
        
        
            if($category->subcategories->isNotEmpty()){
                self::formatTree($category->subcategories,$allCategories);
            }
        }
    }
}