<?php

namespace App\Traits;

use Livewire\Livewire;

trait HasSelect2Wire

{

    public function initSelect2()

    {
        $this->dispatch('select2wire.init');
    }

}
