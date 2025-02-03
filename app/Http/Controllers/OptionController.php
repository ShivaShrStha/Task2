<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OptionController extends Controller
{
    public function getOptions(Request $request)
    {
        $query = $request->input('query');

        // Fetch options from the database
        $options = DB::table('options')
            ->where('option_name', 'LIKE', "%$query%")
            ->pluck('option_name');

        return response()->json($options);
    }
}
