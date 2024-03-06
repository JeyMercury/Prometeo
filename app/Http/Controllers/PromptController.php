<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromptController extends Controller
{
    protected $except = [];

    /**
     * Function to display the different prompts
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // The prompts will be obtained through the datatables

        return view('Prompts.index', [
            'search' => $request->getQueryString(),
        ]);
    }
}
