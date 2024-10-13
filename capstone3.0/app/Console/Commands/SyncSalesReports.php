<?php
// New system: app/Console/Commands/SyncSalesReports.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\LocalReport;

class SyncSalesReports extends Command
{
    protected $signature = 'sync:sales-reports';
    protected $description = 'Sync sales reports from POS system';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $startDate = now()->subDays(30)->toDateString(); // Example: last 30 days
        $endDate = now()->toDateString();

        // Fetch data from the POS system API
        $response = Http::get('https://pos-system-url/api/sales-reports', [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        $salesData = $response->json();

        // Store or update local data
        foreach ($salesData as $data) {
            LocalReport::updateOrCreate(
                ['date' => $data['date']], // Unique on date
                ['total_sales' => $data['total_sales']]
            );
        }

        $this->info('Sales reports synced successfully.');
    }
}
