<?php

namespace App\Livewire;

use App\Models\User as ModelUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class User extends Component
{
    public $menu_list = "see";
    public $user_choosed;
    public $name;
    public $email;
    public $password;
    public $role;

    // Function: Admin Only
    public function mount()
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            abort(403);
        }
    }

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
        $user = new ModelUser;
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

    public function chooseEdit($id)
    {
        // Find User
        $this->user_choosed = ModelUser::findOrFail($id);

        // Change User Record
        $this->name = $this->user_choosed->name;
        $this->email = $this->user_choosed->email;
        $this->role = $this->user_choosed->role;
        $this->role = $this->user_choosed->role;

        // Change menu_list Value
        $this->menu_list = "edit";
    }

    public function chooseDelete($id)
    {
        // Find User
        $this->user_choosed = ModelUser::findOrFail($id);

        // Change menu_list Value
        $this->menu_list = "delete";
    }

    public function cancel()
    {
        // Reset Field
        $this->reset();
    }

    public function updateUser()
    {
        // Data Validation
        $data = $this->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users,email," . $this->user_choosed->id,
            "role" => "required|in:admin,cashier",
        ], [
            "name.required" => "Name is required.",
            "name.string" => "Name must be a string.",
            "email.required" => "Email is required.",
            "email.email" => "Email must be a valid email address.",
            "email.unique" => "This email is already taken.",
            "role.required" => "Role is required.",
            "role.in" => "Role must be either 'admin' or 'cashier'."
        ]);

        // Update User
        $user = $this->user_choosed;
        $user->name = $data["name"];
        $user->email = $data["email"];

        if ($this->password) {
            $user->password = $this->password;
        }

        $user->role = $data["role"];
        $user->save();

        // Reset Field
        $this->reset(["name", "email", "password", "role", "user_choosed"]);

        // Change menu_list Value
        $this->menu_list = "see";
    }

    public function deleteUser()
    {
        // Delete User
        $this->user_choosed->delete();

        // Reset Field
        $this->reset();
    }

    public function render()
    {
        return view('livewire.user')->with([
            "all_user" => ModelUser::all()
        ]);
    }
}
