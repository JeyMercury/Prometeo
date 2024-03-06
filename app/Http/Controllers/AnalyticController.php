<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

class AnalyticController extends Controller
{
    protected $except = [];

    /**
     * Function to display a list of the different analytics
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Analytics.index');
    }
}
