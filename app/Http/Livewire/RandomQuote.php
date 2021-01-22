<?php

namespace App\Http\Livewire;

use App\Models\Quote;
use Livewire\Component;

class RandomQuote extends Component
{
    public ?Quote $quote = null;

    public function mount()
    {
        $this->quote = $this->newQuote();
    }

    public function newQuote()
    {
        return Quote::all()->random();
    }

    public function render()
    {
        return view('livewire.random-quote');
    }
}
