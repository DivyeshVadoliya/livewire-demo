<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class HelloWorld extends Component
{
    public $count = 0;
    public $name = 'Divyesh';

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function render(): View
    {
        return view('livewire.hello-world')
            ->extends('layouts.app')
            ->section('content');
    }
}
