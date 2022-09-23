<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersListItem extends Component
{
    private $user;
    public $userId;
    public $userImage;
    public $userName;
    public $userUsername;
    public $type;


    public function mount(User $user)
    {
        $this->user = User::find($this->userId);
        $this->userImage = $this->user->image;
        $this->userName = $this->user->name;
        $this->userUsername = $this->user->username;
    }

    public function render()
    {
        return view('livewire.users-list-item');
    }
}
