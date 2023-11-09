<?php

namespace App\Livewire\Utility;

use Livewire\Component;

class Btn extends Component
{
    public function render()
    {
        return <<<'HTML'
        <div>
            <button
                    class="px-4 py-2 m-3 text-2xl font-black text-white rounded bg-gradient-to-br from-pink-500 to-purple-700 hover:bg-blue-700"
                    wire:click="inc">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
         </div>
        HTML;
    }
}
