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
use League\Csv\Reader;
use Carbon\Carbon;
use Throwable;

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
        $job = DataJob::findOrFail($this->importId);

        $job->update([
            'status' => 'running',
            'started_at' => now(),
        ]);

        $reportPath = "customer-import/reports/report_{$job->id}.csv";
        $reportFullPath = Storage::disk('local')->path($reportPath);

        if (!file_exists(dirname($reportFullPath))) {
            mkdir(dirname($reportFullPath), 0755, true);
        }

        $report = fopen($reportFullPath, 'w');

        fputcsv($report, ['Row', 'Status', 'Message']);

        $errorCount = 0;

        try {
            $csvPath = Storage::disk('local')->path($job->file_path);
            if (!file_exists($csvPath)) throw new \Exception("CSV file not found");

            $csv = Reader::createFromPath($csvPath, 'r');
            $csv->setHeaderOffset(0);
            $records = $csv->getRecords();

            foreach ($records as $index => $record) {
                try {
                    if (empty($record['name']) || empty($record['email'])) {
                        throw new \Exception("Missing required fields (name or email)");
                    }

                    if (Customer::where('email', $record['email'])->exists()) {
                        fputcsv($report, [$index + 1, 'Skipped', 'Duplicate record (email already exists)']);
                        continue;
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
                        'last_purchase_at' => $this->parseDate($record['last_purchase_at']),
                        'registered_at' => $this->parseDate($record['registered_at']),
                    ]);

                    fputcsv($report, [$index + 1, 'Success', 'Imported successfully']);
                } catch (Throwable $e) {
                    $errorCount++;
                    fputcsv($report, [$index + 1, 'Failed', $e->getMessage()]);
                }
            }

            if ($errorCount === 0) {
                fputcsv($report, ['-', 'Success', 'All records imported successfully. No errors found.']);
            }

            fclose($report);

            $job->update([
                'status' => 'finished',
                'finished_at' => now(),
                'report_path' => $reportPath,
            ]);
        } catch (Throwable $e) {
            fputcsv($report, ['-', 'Fatal Error', $e->getMessage()]);
            fclose($report);

            $job->update([
                'status' => 'failed',
                'finished_at' => now(),
                'error_message' => $e->getMessage(),
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
        DataJob::where('id', $this->importId)->update([
            'status' => 'failed',
            'finished_at' => now(),
            'error_message' => $e->getMessage(),
        ]);
    }
}
