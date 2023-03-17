<div wire:offline.class.remove="bg-success" class="bg-light">

{{--    <div wire:loading.remove>--}}
{{--        <input wire:model="product_search" type="search" placeholder="Search product name...">--}}

{{--        <h1>Search Results:</h1>--}}

{{--        <ul>--}}
{{--            @foreach($products as $product)--}}
{{--                <li>{{ $product->name }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}

    <!-- This is an example component -->
    <div class="max-w-2xl mx-auto">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="p-4">
                <div class="border p-2">
                    <form wire:submit.prevent="submit" id="productEdit">
                        <div class="mb-6">
                            <label class="block mb-2" for="">
                                Title
                                @error('name') <span class="error text-red-500">** {{ $message }}</span> @enderror
                            </label>
                            <input class="w-full text-gray-600 font-light placeholder-gray-300 rounded"
                                   type="text" wire:model="name"  placeholder="Product name" value="{{$name}}">
                            <label class="block mb-2" for="">
                                price
                                @error('price') <span class="error text-red-500">** {{ $message }}</span> @enderror
                            </label>
                            <input class="w-full text-gray-600 font-light placeholder-gray-300 bg-white border-black rounded"
                                   type="text" wire:model="price"  placeholder="Product price" value="{{$price}}">
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2" for="">
                                Status
                            </label>
                            <div class="inline-block leading-6 p-2 w-full items-center pl-4 rounded border-gray-300  bg-white">
                                <input type="radio" id="active"
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                       wire:model="status"  value="1" checked>
                                <label for="active" class="ml-2 pr-48 w-full text-sm font-semibold text-black dark:text-gray-300">
                                    Active
                                </label>
                                <input type="radio" id="inactive" wire:model="status" value="0"
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="inactive" class="py-4 ml-2 w-full text-sm font-semibold text-black dark:text-gray-300">
                                    Inactive
                                </label>
                                @error('status') <span class="error text-red-500">** {{ $message }}</span> @enderror
                            </div>
                        </div>
                        <label class="block mb-2" for="">
                            Content
                            @error('content') <span class="error text-red-500">** {{ $message }}</span> @enderror
                        </label>
                        <input class="w-full text-gray-600 font-light placeholder-gray-300 bg-white border-black rounded"
                               type="text" wire:model="content"  placeholder="Product content" value="{{$content}}">

                        <label class="block mb-2">
                            Category
                        </label>
                        <select id="select-category" wire:model="selectCategory" placeholder="Select category." autocomplete="off"
                                class="block w-full rounded-sm cursor-pointer focus:outline-none" multiple>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">
{{--                                    {{(isset($product) && $product->categories->contains($category) == 1) ?--}}
{{--                                    'selected' : '' }} selected="selected">--}}
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                  clip-rule="evenodd">
                            </path>
                        </svg>
                    </div>
                    <input wire:model="product_search" type="text" id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for product name">
                </div>
            </div>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th sortable wire:click="sortBy('name')" scope="col" class="px-6 py-3">
                            Product name
                        </th>
                        <th sortable wire:click="sortBy('status')" scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th sortable wire:click="sortBy('category')" scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th sortable wire:click="sortBy('price')" scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($products as $product)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        {{ $product->name }}
                    </th>
                    <td class="py-3 px-6 text-center">
                        <span class="py-1 px-3 rounded-full text-xs
                        {{ $product->status ? 'bg-green-200 text-green-600' : 'bg-red-200 text-red-600' }}">
                            {{ $product->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @foreach($product->categories as $category)

                            {{ $category->name }}
                        @endforeach
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->price }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a wire:click="edit({{$product->id}})" href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a wire:click="deleteProduct({{$product->id}})" onclick="return confirm('Are you sure you want to delete this item?');"
                           class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                    </td>
                </tr>
                @empty
                    <td class='px-9 py-9 text-center'>
                        No Product Found...!
                    </td>
                @endforelse
                </tbody>
            </table>
{{--            {{ $products->links() }}--}}
        </div>
    </div>
</div>


