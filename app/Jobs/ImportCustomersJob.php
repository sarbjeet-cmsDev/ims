<?php

namespace App\Jobs;

use App\Models\Customer;
use App\Models\CustomerImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Bus\Dispatchable;
use League\Csv\Reader;
use Throwable;
use Carbon\Carbon;

class ImportCustomersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $importId;

    public function __construct(int $importId)
    {
        $this->importId = $importId;
    }

    public function handle()
    {
        $import = CustomerImport::findOrFail($this->importId);

        $import->update([
            'status' => 'running',
            'started_at' => now(),
        ]);

        $reportPath = "customer-import/reports/report_{$import->id}.log";
        $reportFullPath = Storage::disk('local')->path($reportPath);

        if (!file_exists(dirname($reportFullPath))) {
            mkdir(dirname($reportFullPath), 0755, true);
        }

        $reportHandle = fopen($reportFullPath, 'w');

        try {
            $csvPath = Storage::disk('local')->path($import->file_path);

            if (!file_exists($csvPath)) {
                throw new \Exception("CSV file not found at path: $csvPath");
            }

            fwrite($reportHandle, "Starting import from: $csvPath\n");

            $csv = Reader::createFromPath($csvPath, 'r');
            $csv->setHeaderOffset(0);
            $records = $csv->getRecords();

            foreach ($records as $index => $record) {
                try {
                    if (empty($record['name']) || empty($record['email'])) {
                        throw new \Exception("Missing required fields (name/email)");
                    }

                    Customer::create([
                        'name' => $record['name'],
                        'email' => $record['email'],
                        'phone' => $record['phone'] ?? null,
                        'company_name' => $record['company_name'] ?? null,
                        'contact_person' => $record['contact_person'] ?? null,
                        'customer_type' => $record['customer_type'] ?? null,
                        'tax_id' => $record['tax_id'] ?? null,
                        'status' => $record['status'] ?? null,
                        'notes' => $record['notes'] ?? null,
                        'credit_limit' => (float) ($record['credit_limit'] ?? 0),
                        'total_purchases' => (float) ($record['total_purchases'] ?? 0),
                        'last_purchase_at' => $this->parseDate($record['last_purchase_at'] ?? null),
                        'registered_at' => $this->parseDate($record['registered_at'] ?? null),
                    ]);
                } catch (Throwable $e) {
                    fwrite($reportHandle, "Row $index failed: " . $e->getMessage() . PHP_EOL);
                }
            }

            fclose($reportHandle);

            $import->update([
                'status' => 'finished',
                'finished_at' => now(),
                'report_path' => $reportPath,
            ]);
        } catch (Throwable $e) {
            fwrite($reportHandle, "Fatal Error: " . $e->getMessage() . PHP_EOL);
            fclose($reportHandle);

            $import->update([
                'status' => 'failed',
                'finished_at' => now(),
                'error' => $e->getMessage(),
                'report_path' => $reportPath,
            ]);
        }
    }

    private function parseDate($value)
    {
        try {
            return $value ? Carbon::parse($value) : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function failed(Throwable $e)
    {
        CustomerImport::where('id', $this->importId)->update([
            'status' => 'failed',
            'finished_at' => now(),
            'error' => $e->getMessage(),
        ]);
    }
}
