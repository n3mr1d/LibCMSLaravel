<?php

namespace App\View\Components\Navbar;

use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Navbarnew extends Component
{
    public $user;

    public function __construct()
    {
        if(Auth::check()){
        $this->user = Auth::user();
        }else{
            $this->user= null;
        }
    }

    public function render()
    {
        return view('components.navbar.navbarnew');
    }
}
