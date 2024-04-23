<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateDanUser extends Component
{
    public $user;
    public $username;
    public $email;
    public $password;
    public $password_confirmation;
    public $isOpen = true;

    protected $messages = [
        'username.required' => 'Заавал бөглөнө',
        'email.required' => 'Заавал бөглөнө',
        'password.required' => 'Заавал бөглөнө',
    ];

    public function mount()
    {
        $user = Auth::user();
        // $this->user = User::find($userId->id);

        if (Auth::check()) {
            $this->user = User::find($user->id);
            $this->username = $user->name;
            $this->email = $user->email;
        } else {
            $this->user = null;
        }
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function updateUser()
    {
        $this->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'same:password'
        ]);

        $this->user->update([
            'name' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);


        session()->flash('success', 'User updated successfully.');

        $this->closeModal();

        $this->emit('userUpdated');
    }

    public function render()
    {
        return view('livewire.update-dan-user');
    }
}
