<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>

<form role="form" method="post" action="{{route('store-category')}}">
                    {{csrf_field()}}
                        <div class="mt-4">
                            <label class="text-white " for="username">Category name*</label>

                            <input type="text" name="name" class="
                            block w-4/12
                            
                             border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                            
                            " placeholder="Category name" value="{{old('name')}}" required />
                        </div>
                    
                    
                        <div class="mt-4">

                        <label class="text-white">Select parent category*</label><br>

                            <select type="text" name="parent_id" class="block  px-3 py-1.5 text-base font-normal text-black  bg-clip-padding bg-no-repeat border border-solid border-blue-300 rounded transition ease-in-out m-0">
                                <option value="">None</option>
                                @if($categories)
                                    @foreach($categories as $category)
                                        <?php $dash=''; ?>
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @if(count($category->subcategories))
                                            @include('categories.recursion_partials_category.category_partials',['subcategories' => $category->subcategories])
                                        @endif
                                    @endforeach
                                @endif
                            </select>

                        </div>



                            <div class="mt-4">
                             {{-- <button type="submit" class="bg-white px-4 py-2 rounded text-slate-900">Create</button> --}}
                             <button type="submit">
                             <a href="#_" class="relative inline-flex items-center justify-center px-6 py-3 overflow-hidden font-mono font-medium tracking-tighter text-white bg-gray-800 rounded-lg group">
                                <span class="absolute w-0 h-0 transition-all duration-500 ease-out bg-blue-700 rounded-full group-hover:w-56 group-hover:h-56"></span>
                                <span class="relative text-base text-white">Create</span>
                                </a>
                            </button>
                            </div>
                </form>
    
</body>
</html>