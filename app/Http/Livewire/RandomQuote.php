<?php

namespace App\Http\Livewire;

use App\Models\Quote;
use Livewire\Component;

class RandomQuote extends Component
{
    public ?Quote $quote = null;

    public function render()
    {
        $this->quote = Quote::all()->random();

        return view('livewire.sidebar.random-quote');
    }
}
