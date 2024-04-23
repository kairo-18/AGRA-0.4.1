<?php

namespace App\Livewire;

use Livewire\Component;

class CodeEditor extends Component
{
    public $output = "";
    public $code = "";

    // Method to handle the "Run" button click
    public function executeCode()
    {
        // Perform any necessary processing or execution of the code here
        // For demonstration purposes, I'll just store the code in the $output property
        $this->output = $this->code;
    }

    public function render()
    {
        return view('livewire.code-editor');
    }
}
