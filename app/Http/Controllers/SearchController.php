<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function autocomplete(Request $req) {
        $data = Service::select('name')->where("name", "LIKE","%{$req->input('query')}%")->get();
        return response()->json($data);
    }
}
