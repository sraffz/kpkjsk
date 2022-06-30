<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class voltController extends Controller
{
    public function index()
    {
        return view('volt.index');
    }

    public function dashboard()
    {
        return view('volt.pages.dashboard.dashboard');
    }

    public function transactions()
    {
        return view('volt.pages.transactions');
    }

    public function setting()
    {
        return view('volt.pages.settings');
    }

    public function upgradepro()
    {
        return view('volt.pages.upgrade-to-pro');
    }

    public function tables()
    {
        return view('volt.pages.table');
    }

    public function signIn()
    {
        return view('volt.pages.examples.sign-in');
    }

    public function signUp()
    {
        return view('volt.pages.examples.sign-up');
    }

    public function forgotPassword()
    {
        return view('volt.pages.examples.forgot-password');
    }

    public function resetPassword()
    {
        return view('volt.pages.examples.reset-password');
    }

    public function lock()
    {
        return view('volt.pages.examples.lock');
    }

    public function error1()
    {
        return view('volt.pages.examples.404');
    }

    public function error2()
    {
        return view('volt.pages.examples.500');
    }

    public function buttons()
    {
        return view('volt.pages.components.buttons');
    }

    public function forms()
    {
        return view('volt.pages.components.forms');
    }

    public function notifications()
    {
        return view('volt.pages.components.notifications');
    }

    public function modals()
    {
        return view('volt.pages.components.modals');
    }

    public function typography()
    {
        return view('volt.pages.components.typography');
    }
}
