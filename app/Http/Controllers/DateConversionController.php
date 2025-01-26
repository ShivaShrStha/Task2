<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelNepaliDate;

class DateConversionController extends Controller
{
    public function convertDate(Request $request)
    {
        $engDate = $request->input('engDate');
        $nepaliDate = LaravelNepaliDate::from($engDate)->toNepaliDate();
        return response()->json(['nepaliDate' => $nepaliDate]);
    }
}
