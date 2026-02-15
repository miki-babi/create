<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramService
{
    protected string $token;

    public function __construct()
    {
    $this->token = env('PROMOTER_TOKEN');
    }

    public function sendMiniAppButton($chatId)
    {
        return Http::post(
            "https://api.telegram.org/bot{$this->token}/sendMessage",
            [
                'chat_id' => $chatId,
                'text' => "Open the Mini App 👇",
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [
                            [
                                'text' => 'Launch Mini App 🚀',
                                'web_app' => [
                                    'url' => 'https://create.axumcode.com/promoter/miniapp-init'
                                ]
                            ]
                        ]
                    ]
                ])
            ]
        );
    }
}