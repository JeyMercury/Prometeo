<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExtraInfo;

class ExtraInfoController extends Controller
{
    protected $except = [];

    /**
     * Function to display a list of the different extra info
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // The extra info will be obtained through the datatables

        return view('Extra_info.index', [
            'search' => $request->getQueryString(),
        ]);
    }

    public function create(ExtraInfo $extraInfo) {

        return view('Extra_info.create');
    }
}
