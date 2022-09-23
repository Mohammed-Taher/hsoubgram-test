<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Search extends Component
{
    public $searchInput;
    public $results = [];

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function search()
    {
        if ($this->searchInput == '') {
            $this->results = [];
            $this->emit('refreshComponent');
        }
        $this->results = User::where('username', 'LIKE', '%' . $this->searchInput . '%')->where('id', '<>', auth()->id())->take(8)->get(['id', 'name', 'username', 'image']);
        $this->emit('refreshComponent');
    }

    public function render()
    {
        return view('livewire.search');
    }
}
