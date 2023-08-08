<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>

 <div class=" w-full mx-auto mt-4 overflow-x-auto shadow-md rounded-lg">
        
            {{-- <a href="{{route('createCategory')}}" class=" text-white bg-blue-800 rounded px-8 py-3 leading-10"> Add Category</a> --}}
          
        
            <table class="w-full  text-sm text-left text-gray-400">
                
                    
    

                <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                    <tr>

                        <th scope="col" class="py-3 px-3 text-light text-base">S.No.</th>
                        <th scope="col" class="py-3 px-3 text-light text-base">Id</th>
                        <th scope="col" class="py-3 px-3 text-light text-base">Category Name</th>
                        <th scope="col" class="py-3 px-3 text-light text-base">Category Slug</th>
                        <th scope="col" class="py-3 px-3 text-light text-base">Parent Category</th>
                        <th scope="col" class="py-3 px-3 text-light text-base">Category Level</th>
                        <th scope="col" class="py-3 px-3 text-light text-base">Edit</th>
                        <th scope="col" class="py-3 px-3 text-light text-base">Delete</th>
                    
                    </tr>
                </thead>
                <tbody>
                    @if(isset($categories))
                    <?php $_SESSION['i'] = 0; ?>
                    @foreach($categories as $category)
                        
                    <?php $_SESSION['i']=$_SESSION['i']+1; ?>
                    <tr class=" border-b bg-slate-900 border-gray-700 hover:bg-slate-800">
                        <?php $dash=''; ?>
                        <th scope="row" class="py-4 px-3 font-medium  text-lg whitespace-nowrap">
                            {{$_SESSION['i']}}
                        </th>
                        <td class="py-4 px-3">
                            {{$category->id}}
                        </td>
                        <td class="py-4 px-3 text-lg text-white font-normal">
                            {{$category->name}}
                        </td>

                        <td class="py-4 px-3  text-lg">
                            
                        </td>
                       
                        <td class="py-4 px-3  text-lg">
                            None
                        </td>
                        
                        <td class="py-4 px-3  text-lg">
                            @if(isset($category->parent_id))
                                {{$category->subcategory->name}}
                                <td>{{$loop->depth}}</td>
                        
                            @else
                            
                        1 Level
                            @endif
                        </td>

                        <td class="py-4 px-3">
                            <a class="font-medium text-blue-500 hover:underline" href="{{route('edit-category', $category->id)}}">
                                <button class="btn-edit  px-8 py-1 rounded  text-lg">Edit</button>
                            </a>
                        </td>

                        <td class="py-4 px-3">                                  
                        
                            <form action="{{route('delete-category', $category->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                            
                            <button style="" type="submit" value="DELETE" class="btn-delete font-medium  px-8 py-1 rounded  text-lg hover:underline">DELETE</button>
                            </form>
                        </td>



                        
                    </tr>
                    @if(count($category->subcategories))
                    @include('categories.recursion_partials_category.index_category_partials',['subcategories' => $category->subcategories])
                    @endif
            
                    @endforeach
                    <?php unset($_SESSION['i']); ?>
                    @endif
                    
                </tbody>
            </table>


        </div>
    
</body>
</html>