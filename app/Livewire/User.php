<?php

namespace App\Livewire;

use App\Models\User as ModelsUser;
use Livewire\Component;

class User extends Component
{
    public $menu_list = "see";
    public $name;
    public $email;
    public $password;
    public $role;

    public function chooseMenu($menu)
    {
        $this->menu_list = $menu;
    }

    public function addUser()
    {
        // Data Validation
        $data = $this->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:8",
            "role" => "required|in:admin,cashier",
        ], [
            "name.required" => "Name is required.",
            "name.string" => "Name must be a string.",
            "email.required" => "Email is required.",
            "email.email" => "Email must be a valid email address.",
            "email.unique" => "This email is already taken.",
            "password.required" => "Password is required.",
            "password.string" => "Password must be a string.",
            "password.min" => "Password must be at least 8 characters long.",
            "role.required" => "Role is required.",
            "role.in" => "Role must be either 'admin' or 'cashier'."
        ]);

        // Create User
        $user = new ModelsUser;
        $user->name = $data["name"];
        $user->email = $data["email"];
        $user->password = $data["password"];
        $user->role = $data["role"];
        $user->save();

        // Reset Field
        $this->reset(["name", "email", "password", "role"]);

        // Change menu_list Value
        $this->menu_list = "see";
    }

    public function render()
    {
        return view('livewire.user')->with([
            "all_user" => ModelsUser::all()
        ]);
    }
}
