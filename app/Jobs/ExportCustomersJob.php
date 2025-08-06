<?php

namespace App\Jobs;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\CustomerExport;

class ExportCustomersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $export;

    public function __construct(CustomerExport $export)
    {
        $this->export = $export;
    }

    public function handle()
    {
        $this->export->update([
            'status' => 'running',
            'started_at' => now(),
        ]);

        try {
            $exportDir = storage_path('app/exports');
            if (!is_dir($exportDir)) {
                mkdir($exportDir, 0755, true);
            }

            $fileName = 'exports/customers_' . now()->format('Y_m_d_H_i_s') . '.csv';
            $filePath = storage_path('app/' . $fileName);

            $handle = fopen($filePath, 'w');

            fputcsv($handle, [
                'ID', 'Name', 'Email', 'Phone', 'Company', 'Contact Person',
                'Customer Type', 'Tax ID', 'Status', 'Credit Limit',
                'Total Purchases', 'Last Purchase', 'Registered At'
            ]);

            Customer::chunk(1000, function ($customers) use ($handle) {
                foreach ($customers as $customer) {
                    fputcsv($handle, [
                        $customer->id,
                        $customer->name,
                        $customer->email,
                        $customer->phone,
                        $customer->company_name,
                        $customer->contact_person,
                        $customer->customer_type,
                        $customer->tax_id,
                        $customer->status,
                        $customer->credit_limit,
                        $customer->total_purchases,
                        optional($customer->last_purchase_at)->toDateTimeString(),
                        optional($customer->registered_at)->toDateTimeString(),
                    ]);
                }
            });

            fclose($handle);

            $this->export->update([
                'status' => 'finished',
                'file_path' => $fileName,
                'finished_at' => now(),
            ]);
        } catch (\Throwable $e) {
            $this->export->update([
                'status' => 'failed',
                'error' => $e->getMessage(),
            ]);
        }
    }
}
