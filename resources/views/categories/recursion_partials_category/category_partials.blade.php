<?php $dash.='----> '; ?>
@foreach($subcategories as $subcategory)
    @if($category->id != $subcategory->id )
        <option value="{{$subcategory->id}}" @if($category->parent_id == $subcategory->id ) selected @endif >
        	{!!$dash!!}{{$subcategory->name}}
        </option>
    @endif
    @if(count($subcategory->subcategories))
        @include('categories.recursion_partials_category.category_partials',['subcategories' => $subcategory->subcategories])
    @endif
@endforeach
