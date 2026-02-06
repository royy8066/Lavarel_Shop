<?php

namespace App\Services\Chat;

class AiClient
{
    public function send(array $messages): string
    {
        $provider = env('AI_PROVIDER', 'openai');
        $model = env('AI_MODEL', env('OPENAI_MODEL', 'gpt-3.5-turbo'));

        switch (strtolower($provider)) {
            case 'anthropic':
                return $this->anthropic($model, $messages);
            case 'google':
            case 'gemini':
                return $this->googleGemini($model, $messages);
            case 'deepseek':
                return $this->deepseek($model, $messages);
            case 'xai':
            case 'grok':
                return $this->xaiGrok($model, $messages);
            case 'openai':
            default:
                return $this->openai($model, $messages);
        }
    }

    private function openai(string $model, array $messages): string
    {
        $apiKey = env('OPENAI_API_KEY');
        if (!$apiKey) throw new \RuntimeException('Missing OPENAI_API_KEY');

        $payload = [
            'model' => $model,
            'messages' => $this->normalizeToChat($messages),
            'temperature' => (float) env('AI_TEMPERATURE', 0.7),
            'max_tokens' => (int) env('AI_MAX_TOKENS', 512),
        ];

        $res = $this->httpPost('https://api.openai.com/v1/chat/completions', $payload, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiKey,
        ]);

        $data = json_decode($res, true);
        return $data['choices'][0]['message']['content'] ?? ($data['choices'][0]['text'] ?? '');
    }

    private function anthropic(string $model, array $messages): string
    {
        $apiKey = env('ANTHROPIC_API_KEY');
        if (!$apiKey) throw new \RuntimeException('Missing ANTHROPIC_API_KEY');

        $anthropicMessages = [];
        foreach ($messages as $m) {
            if (($m['role'] ?? 'user') === 'system') {
                // prepend as system instruction
                $anthropicMessages[] = ['role' => 'user', 'content' => [['type' => 'text', 'text' => "[SYSTEM]\n" . $m['content']]]];
            } else {
                $role = $m['role'] === 'assistant' ? 'assistant' : 'user';
                $anthropicMessages[] = ['role' => $role, 'content' => [['type' => 'text', 'text' => (string)$m['content']]]];
            }
        }

        $payload = [
            'model' => $model ?: 'claude-3-sonnet-20240229',
            'max_tokens' => (int) env('AI_MAX_TOKENS', 512),
            'temperature' => (float) env('AI_TEMPERATURE', 0.7),
            'messages' => $anthropicMessages,
        ];

        $res = $this->httpPost('https://api.anthropic.com/v1/messages', $payload, [
            'Content-Type: application/json',
            'x-api-key: ' . $apiKey,
            'anthropic-version: 2023-06-01',
        ]);
        $data = json_decode($res, true);
        return $data['content'][0]['text'] ?? '';
    }

    private function googleGemini(string $model, array $messages): string
{
    $apiKey = env('GOOGLE_API_KEY');
    if (!$apiKey) {
        throw new \RuntimeException('Missing GOOGLE_API_KEY');
    }

    // Chỉ lấy message của user (Gemini không hiểu role system)
    $parts = [];
    foreach ($messages as $m) {
        if (($m['role'] ?? 'user') !== 'assistant') {
            $parts[] = ['text' => (string) $m['content']];
        }
    }

    $payload = [
        'contents' => [
            [
                'role' => 'user',
                'parts' => $parts,
            ]
        ],
        'generationConfig' => [
            'temperature' => (float) env('AI_TEMPERATURE', 0.7),
            'maxOutputTokens' => (int) env('AI_MAX_TOKENS', 512),
        ],
    ];

    // ⚠️ Gemini PRO chạy ổn nhất cho đồ án
    $model = $model ?: 'gemini-pro';

    $url = "https://generativelanguage.googleapis.com/v1/models/{$model}:generateContent?key={$apiKey}";

    $res = $this->httpPost($url, $payload, [
        'Content-Type: application/json'
    ]);

    $data = json_decode($res, true);

    if (!is_array($data)) {
        throw new \RuntimeException('Invalid JSON from Gemini: ' . $res);
    }

    if (!isset($data['candidates'][0]['content']['parts'][0]['text'])) {
        throw new \RuntimeException('Unexpected Gemini response: ' . json_encode($data));
    }

    return $data['candidates'][0]['content']['parts'][0]['text'];
}


    private function xaiGrok(string $model, array $messages): string
    {
        $apiKey = env('XAI_API_KEY');
        if (!$apiKey) throw new \RuntimeException('Missing XAI_API_KEY');

        // Grok is OpenAI-compatible per latest docs
        $payload = [
            'model' => $model ?: 'grok-2',
            'messages' => $this->normalizeToChat($messages),
            'temperature' => (float) env('AI_TEMPERATURE', 0.7),
            'max_tokens' => (int) env('AI_MAX_TOKENS', 512),
        ];

        $res = $this->httpPost('https://api.x.ai/v1/chat/completions', $payload, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiKey,
        ]);
        $data = json_decode($res, true);
        return $data['choices'][0]['message']['content'] ?? '';
    }

    private function normalizeToChat(array $messages): array
    {
        $out = [];
        foreach ($messages as $m) {
            $out[] = [
                'role' => $m['role'] ?? 'user',
                'content' => (string) ($m['content'] ?? ''),
            ];
        }
        if (empty($out)) {
            $out[] = ['role' => 'user', 'content' => ''];
        }
        return $out;
    }

    private function httpPost(string $url, array $payload, array $headers): string
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_TIMEOUT, 45);
        $res = curl_exec($ch);
        $err = curl_error($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($err || $status >= 400) {
            throw new \RuntimeException('HTTP error: ' . ($err ?: $status) . ' body=' . $res);
        }
        return $res;
    }
}
