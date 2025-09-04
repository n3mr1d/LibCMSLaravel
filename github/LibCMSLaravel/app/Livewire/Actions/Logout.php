<?php

    namespace App\Livewire\Actions;

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Session;

    class Logout
    {
        /**
         * Log the current user out of the application.
         */
        public function __invoke()
        {
            $user = Auth::user();
            $user->last_login_at = now();
            $user->save();

            Auth::guard('web')->logout();

            Session::invalidate();
            Session::regenerateToken();

            return redirect('/');
        }
    }
