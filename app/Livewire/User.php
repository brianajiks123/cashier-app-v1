<?php

namespace App\Livewire;

use App\Models\User as ModelsUser;
use Livewire\Component;

class User extends Component
{
    public $menu_list = "see";

    public function chooseMenu($menu)
    {
        $this->menu_list = $menu;
    }

    public function render()
    {
        return view('livewire.user')->with([
            "all_user" => ModelsUser::all()
        ]);
    }
}
