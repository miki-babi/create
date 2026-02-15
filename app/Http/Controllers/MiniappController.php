<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MiniappController extends Controller
{
    //
    public function handleInit(Request $request)
    {
        $initData = $request->input('initData');

        // Log or process Telegram init payload
        Log::info('Telegram MiniApp initData:', ['initData' => $initData]);

        // Example: save user info in session
        session(['telegram_user' => $initData]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Init received'
        ]);
    }
}
