<?php


namespace App\Jobs;

use App\Models\Customer;
use App\Models\DataJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;

class ExportCustomersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $jobId;

    public function __construct(int $jobId)
    {
        $this->jobId = $jobId;
    }

    public function handle()
    {
        $job = DataJob::findOrFail($this->jobId);

        $job->update([
            'status' => 'running',
            'started_at' => now(),
        ]);

        try {
            $fileName = 'exports/customers_' . now()->format('Ymd_His') . '.csv';
            $filePath = storage_path('app/' . $fileName);
            $dir = dirname($filePath);

            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }

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

            $job->update([
                'status' => 'finished',
                'file_path' => $fileName,
                'finished_at' => now(),
            ]);
        } catch (\Throwable $e) {
            $job->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);
        }
    }
}
