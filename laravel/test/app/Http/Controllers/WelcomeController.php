<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //used in routes.api.php
    
    public function welcome(){
        return 'welcome to API';
    }
}
