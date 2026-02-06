<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class InvoiceService
{
    public function sendInvoiceByEmail(Order $order)
    {
        // Detect language preference
        $lang = $this->detectLanguage($order);
        $isEnglish = $lang === 'en';
        
        // Tạo PDF
        $pdfView = $isEnglish ? 'frontend.invoice_en' : 'frontend.invoice';
        $pdf = Pdf::loadView($pdfView, compact('order'));
        $pdfFileName = 'invoice_' . $order->id . '_' . now()->format('Y-m-d_H-i-s') . '.pdf';
        $pdfPath = storage_path('app/public/invoices/' . $pdfFileName);

        // Đảm bảo thư mục tồn tại
        $dir = dirname($pdfPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        // Lưu PDF
        $pdf->save($pdfPath);

        // Gửi email kèm PDF
        try {
            $emailView = $isEnglish ? 'frontend.invoice_email_en' : 'frontend.invoice_email';
            $subject = $isEnglish 
                ? 'Invoice #' . $order->id . ' - Trầm Hương Tiên Phước'
                : 'Hóa đơn #' . $order->id . ' - Trầm Hương Tiên Phước';
                
            Mail::send($emailView, compact('order'), function ($message) use ($order, $pdfPath, $pdfFileName, $subject) {
                $message->to($order->email)
                    ->subject($subject)
                    ->attach($pdfPath, [
                        'as' => $pdfFileName,
                        'mime' => 'application/pdf',
                    ]);
            });

            // Xóa file tạm sau khi gửi (tùy chọn)
            // unlink($pdfPath);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send invoice email: ' . $e->getMessage());
            return false;
        }
    }

    public function detectLanguage(Order $order)
    {
        // 1. Check if customer has language preference in session/cookie
        if (session()->has('locale')) {
            return session('locale');
        }
        
        // 2. Check browser language from Accept-Language header
        $acceptLanguage = request()->header('Accept-Language', '');
        if (strpos($acceptLanguage, 'en') === 0) {
            return 'en';
        }
        
        // 3. Check customer name/email pattern (simple heuristic)
        if ($this->isLikelyForeignCustomer($order->fullname, $order->email)) {
            return 'en';
        }
        
        // Default to Vietnamese
        return 'vi';
    }

    private function isLikelyForeignCustomer($name, $email)
    {
        // Simple heuristic: if name contains only ASCII characters and email has common foreign domains
        $name = trim($name);
        if (!preg_match('/[\p{L}\p{M}]/u', $name) || preg_match('/^[a-zA-Z\s\-\.]+$/', $name)) {
            return true;
        }
        
        $foreignDomains = ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com'];
        $domain = substr(strrchr($email, "@"), 1);
        return in_array($domain, $foreignDomains) && !preg_match('/[\p{L}\p{M}]/u', $name);
    }
}
