<?php $dash.='-- '; ?>
@foreach($subcategories as $subcategory)
   
    <tr class=" border-b bg-slate-900 border-gray-700 hover:bg-slate-800">
        <?php $_SESSION['i']=$_SESSION['i']+1; ?>
         <td class="py-4 px-3  text-lg ">{{$_SESSION['i']}}</td>
        <td class="py-4 px-3  text-lg ">{{$subcategory->id}}</td>
        <td class="py-4 px-3  text-lg text-white">{{$dash}}{{$subcategory->name}}</td>
        <td class="py-4 px-3  text-lg">{{$subcategory->slug}}</td>
        
        
        <td class="py-4 px-3  text-lg">{{$subcategory->parent->name}}</td>
    
        
        <td class="py-4 px-3  text-lg">{{$loop->depth}} Level</td>
        <td class="py-4 px-3 ">
            <a class="font-mediumtext-blue-500 hover:underline" href="{{Route('edit-category', $subcategory->id)}}">
                <button class="btn-edit px-8 py-1 rounded text-lg">Edit </button>
            </a>
        </td>

        <td class="py-4 px-3 ">
        
            
            <form action="{{route('delete-category',  $subcategory->id)}}" method="POST">
                @csrf
                @method('DELETE')
            
              <button class="btn-delete px-8 py-1 rounded  text-lg" type="submit" value="DELETE" class="btn btn-danger">DELETE</button>
            </form>

        </td>
   
    </tr>
    @if(count($subcategory->subcategories))
        @include('categories.recursion_partials_category.index_category_partials',['subcategories' => $subcategory->subcategories])
    @endif
@endforeach