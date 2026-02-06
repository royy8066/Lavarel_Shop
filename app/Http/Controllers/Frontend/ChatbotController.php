<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Chat\AiClient;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('frontend.chatbot');
    }

    public function message(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        try {
            $client = new AiClient();
            $reply = $client->send([
                [
                    'role' => 'system',
                    'content' => "Bạn là trợ lý AI chuyên về mảng (array) và các thao tác/thuật toán trên mảng. Luôn trả lời bằng tiếng Việt, ngắn gọn, rõ ràng, có ví dụ minh họa.\nPhạm vi: kiểu dữ liệu mảng, thao tác (thêm/xóa/sửa/tìm/duyệt/sắp xếp), độ phức tạp thời gian, tối ưu bộ nhớ, lỗi phổ biến, và so sánh cấu trúc liên quan (list, set, map).\nKhi người dùng không rõ ngữ cảnh (ngôn ngữ lập trình), hãy hỏi họ muốn ví dụ bằng ngôn ngữ nào (PHP/JS/Python/Java/C++)."
                ],
                [
                    'role' => 'user',
                    'content' => (string) $request->input('message')
                ],
            ]);
            return response()->json(['reply' => $reply]);
        } catch (\Throwable $e) {
            Log::error('Chatbot error', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'API error', 'detail' => $e->getMessage()], 500);
        }
    }
}
