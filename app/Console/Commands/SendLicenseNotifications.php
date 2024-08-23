<?php

namespace App\Console\Commands;

use App\Models\Contact;
use App\Models\Licence;
use App\Services\WhatsAppService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendLicenseNotifications extends Command
{
    protected $signature = 'licences:send-notifications';
    protected $description = 'Send WhatsApp notifications for expiring licences';
    protected $whatsAppService;

    public function __construct(WhatsAppService $whatsAppService)
    {
        parent::__construct();
        $this->whatsAppService = $whatsAppService;
    }

    public function handle()
    {
        $licences = Licence::all();
        $contacts = Contact::all();
        $today = Carbon::today();

        foreach ($licences as $licence) {
            $endDate = Carbon::parse($licence->end_date);

            foreach ($licence->notification->notification_days as $days) {
                $notificationDate = $endDate->copy()->subDays($days);

                if ($notificationDate->isSameDay($today)) {
                    foreach ($contacts as $contact) {
                        $this->sendWhatsAppNotification($contact, $licence, $days);
                    }
                    break;
                }
            }
        }

    }

    private function sendWhatsAppNotification($contact, $licence, $daysUntilExpiry)
    {
        $message = "Kepada Yth. {$contact->name},\\n\\nKami ingin menginformasikan bahwa lisensi berikut akan segera berakhir:\\n\\nJenis: {$licence->licenceType->name}\\nNama: {$licence->name}\\nDurasi: {$licence->notification->duration_type}\\nTanggal Mulai: {$licence->start_date}\\nTanggal Berakhir: {$licence->end_date}\\nSisa Waktu: {$daysUntilExpiry} hari\\nPenyedia: {$licence->provider}\\nBiaya: Rp {$licence->amount}\\n\\nTerima kasih atas perhatiannya.\\n\\nHormat kami,\\nTim Lisensi YPT";

        $response = $this->whatsAppService->sendMessage($contact->whatsapp_number, $message);

        Log::info('WhatsApp notification response: ' . $response);
    }
}
