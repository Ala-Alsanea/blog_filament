<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{

    public string $name = "LiveWire";
    public  $count = 0;
    public  $title ='';

    public function inc ()
    {
        $this->count++;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
