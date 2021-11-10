<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class DocumentController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index($document): JsonResponse
    {
        return response()->json(compact($document));
    }
}
