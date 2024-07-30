<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $users = [
            [
                'name' => 'noor',
                'age' => 20,
            ],
            [
                'name' => 'mohamed',
                'age' => 15
            ]
        ];

        return view('dashboard',
        [
            'users' => $users
        ]
    );
    }
}
