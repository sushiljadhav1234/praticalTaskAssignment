<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{


    public function editCategory($id)
    {

        $category = Category::with('subcategories')->findOrFail($id);
       
        $categories = Category::where('parent_id', null)->where('id', '!=', $category->id)->get();
         
        return view('categories.edit')->with('category',$category)->with('categories',$categories);

    }

    public function updateCategory(Request $request,$id)
    {

        $category = Category::findOrFail($id);

        function getRecursiveCategoryId($id){

            $children = [];
            $parentCategories = Category::where('parent_id', $id)
                          ->latest()
                          ->select('id')
                          ->get();

            foreach ($parentCategories as $category) {

                // $category_new = $category->id.',' ;
                // echo  $category_new;

                $children[] = $category->id;
                $children = array_merge($children,is_array(getRecursiveCategoryId($category->id))?getRecursiveCategoryId($category->id):[] );

                // $children[$category->id] = getRecursiveCategoryId($category->id,$children);
            
            }
                              
            return $children;                        
        }

        $arraySubCategoryIds = getRecursiveCategoryId($id);


            $validator = $request->validate([
                'name'     => 'required',
                'parent_id'=> 'nullable|numeric'
            ]);
            if($request->name != $category->name || $request->parent_id != $category->parent_id)
            {
                if(isset($request->parent_id))
                {
                    $checkDuplicate = Category::where('name', $request->name)->where('parent_id', $request->parent_id)->first();
                    if($checkDuplicate)
                    {
                        return redirect()->back()->with('error', 'Category already exist in this parent.');
                    }
                }
                else
                {
                    $checkDuplicate = Category::where('name', $request->name)->where('parent_id', null)->first();
                    if($checkDuplicate)
                    {
                        return redirect()->back()->with('error', 'Category already exist with this name.');
                    }
                }
            }
     
            $category->name = $request->name;
            $category->parent_id = $request->parent_id;

            if(in_array($category->parent_id,$arraySubCategoryIds)){

                return redirect()->back()->with('danger error', 'You Cannot Add '. $category->name.' Category To Its Subcategories [RESTRICTED].');   
            }
           
           
            $category->save();
            

            return redirect()->route('index-category');
    
    
    }

    public function indexCategory()
    {

        $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();

        return view('categories.index')->with('categories',$categories);
    }
    
    public function createCategory()
    {
    
        $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();

        return view('categories.create')->with('categories',$categories);        
    }

    public function storeCategory(Request $request)
    {
        $validator = $request->validate([
            'name'      => 'required',
            'parent_id' => 'nullable|numeric'
        ]);

        Category::create([
            'name' => $request->name,
            'parent_id' =>$request->parent_id
        ]);

        return redirect()->route('index-category');        
    }

    public function deleteCategory($id)
    {
        
        $category = Category::findOrFail($id);
 
       if($category->subcategories->toArray() !== '[]'){
       
            $category->with('subcategories')->delete();
       }else{

            $category->delete();
       }

        return redirect()->back()->with('delete', 'Category has been deleted successfully.');
    
    }
}

