<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TimeService;

class ExampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get the time
        $time =  TimeService::getNow();

        // display the time
        return view('example', ['time' => $time]);
    }
}
