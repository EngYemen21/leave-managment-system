<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class Logout extends Component
{
    public function logout( Request $request)
    {Auth::logout();
       

        return redirect()->route('login');
    }
    public function render()
    {
        return view('livewire.auth.logout');
    }
}
