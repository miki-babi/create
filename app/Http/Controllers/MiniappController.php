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

        public function promoterOnboard(Request $request)
    {
        $tgUser = $request->all();
        Log::info('Telegram WebApp User:', $tgUser);

        $tgId = $tgUser['id'] ?? null;
        // Check if Telegram ID is provided
        Log::info('Telegram ID:', ['tgId' => $tgId]);

        $promoter = \App\Models\Promoter::updateOrCreate(
            ['telegramid' => $tgId],
            [
                // 'company_name' => 'Telegram User ' . $tgId,
                'telegramid' => $tgUser['id'] ?? null,
                // 'company_description' => 'Registered via Telegram Webhook',
                'is_verified' => false,
            ]
        );

        if ($promoter) {
            $user=\App\Models\User::updateOrCreate(
                ['telegramid' => $tgId],
                [
                    'name' => $tgUser['first_name'] ?? 'Telegram User',
                    'telegramid' => $tgUser['id'] ?? null,
                    'email' => null,
                    'password' => null,
                    'role' => 'promoter',
                ]
            );
            Log::info("Promoter record created or found for Telegram ID: {$tgId}");

        } else {
            Log::error("Failed to create or find promoter for Telegram ID: {$tgId}");
        }

        return response()->json([
            'status' => 'ok',
            'message' => 'Promoter onboarded successfully',
            'redirect' => route('miniapp.main', ['tgId' => $tgId])
        ]);
        
    }
}
