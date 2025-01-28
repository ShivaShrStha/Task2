<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DistrictController extends Controller
{
    public function getDistricts()
    {
        $filePath = public_path('Districts.xltx');
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 500);
        }

        try {
            $data = Excel::toCollection(null, $filePath);
            if ($data->isEmpty()) {
                return response()->json(['error' => 'Excel file is empty or unreadable'], 500);
            }

            $sheet = $data->first();
            $districts = $sheet->pluck(2)->filter()->values();
            return response()->json($districts);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to read Excel file: ' . $e->getMessage()], 500);
        }
    }
}
