<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Arr;
use Livewire\Component;
//use Livewire\WithPagination;

class ProductList extends Component
{
    public $product_search;
    public $product;
    public $sortField = 'id';
    public $sortDirection = 'desc';

    //use WithPagination;
    //protected $queryString = ['product_search'];
    public $name;
    public $status;
    public $price;
    public $content;
    public $selectCategory;
    public $proId;
    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field ?
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc' :
            $this->sortDirection = 'asc';
        $this->sortField = $field;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'name' => 'required',
            'status' => 'required|boolean',
            'price' => 'required|numeric',
            'content' => 'required',
            'selectCategory' => 'required|array'
        ]);
    }

    public function submit()
    {
        $data = $this->validate([
            'name' => 'required',
            'status' => 'required|boolean',
            'price' => 'required|numeric',
            'content' => 'required',
            'selectCategory' => 'required|array'
        ]);
        //dd($data['selectCategory']);
        if(!empty($this->product)) {
            //$product = Product::query()->where('id', $this->proId->id)->first();
            //dd($product);
            $this->product->update(Arr::except($data, ['selectCategory']));
            $this->product->categories()->sync($data['selectCategory']);
            $this->proId = null;
        }
        else {
            Product::query()->create(Arr::except($data, ['selectCategory']))->categories()->attach($data['selectCategory']);
        }

        $this->reset();
    }

    public function deleteProduct($id)
    {
        Product::query()->find($id)->delete();
    }

    public function edit($id)
    {
        $product = Product::query()->where('id', $id)->first();
        $this->product = $product;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->status = $product->status;
        $this->content = $product->content;
        $this->selectCategory = $product->categories->pluck('id');
    }

    public function render()
    {
        $product = Product::query()
            ->where('name', 'like', '%'.$this->product_search.'%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();

        $categories = Category::query()->where('status', 1)->get();

        return view('livewire.product-list',['products' => $product, 'categories' => $categories])
            ->extends('layouts.app')
            ->section('content');
    }
}
