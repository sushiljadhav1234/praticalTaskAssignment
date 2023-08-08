<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    
<form role="form" method="post" action="{{route('update-category', ['id' => $category->id])}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PUT">


                <div class="mt-4">
                    <label class="text-white dark:text-gray-200">Category name*</label>
                    <input type="text" name="name" class="block w-full
                    border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                     " placeholder="Category name" value="{{$category->name}}" required />
                </div>


                <div class="mt-4">
                    <label class="text-gray-900 ">Select parent category*</label>
                                        
                    <select type="text" name="parent_id" class=" block  px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-blue-300 rounded transition ease-in-out m-0">
                        <option value="">root</option>
                
                        @if($categories)
                        @foreach($categories as $item)
                        {{$item->subcategories}}
                        <?php $dash=''; ?>
                        <option value="{{$item->id}}" @if($category->parent_id == $item->id ) selected @endif>{{$item->name}}</option>
                            @if(count($item->subcategories))
                                @include('categories.recursion_partials_category.category_partials',['subcategories' => $item->subcategories])
                            @endif
                        @endforeach
                        @endif
                    </select>

                </div>

                <div class="mt-4">
                    <button type="submit" class="bg-white px-4 py-2 rounded text-slate-900">Update</button>
                </div>

            </form>    
</body>
</html>