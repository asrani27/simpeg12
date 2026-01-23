<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Dms;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportDmsFromExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dms:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import DMS data from Excel file (public/excel/data_dms.xlsx) to Dms table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = public_path('excel/data_dms.xlsx');

        // Check if file exists
        if (!file_exists($filePath)) {
            $this->error("File tidak ditemukan: {$filePath}");
            return 1;
        }

        $this->info("Memulai import data DMS dari: {$filePath}");

        try {
            // Load the Excel file
            $spreadsheet = IOFactory::load($filePath);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            // Remove header row (start from row 2)
            array_shift($rows);

            $imported = 0;
            $skipped = 0;

            // Start progress bar
            $this->output->progressStart(count($rows));

            foreach ($rows as $index => $row) {
                // Skip empty rows
                if (empty(array_filter($row))) {
                    $skipped++;
                    $this->output->progressAdvance();
                    continue;
                }

                // Map columns (0-based index from Excel)
                // A=0: nip, B=1: nama, C=2: drh, D=3: sk_cpns, E=4: d2np, F=5: spmt, G=6: sk_pns

                // Helper function to transform column values
                $transformValue = function ($value) {
                    // Convert to uppercase for comparison
                    $upperValue = strtoupper(trim($value));

                    if ($upperValue === 'X') {
                        return NULL;
                    } elseif ($value === null || $value === '') {
                        return 'sudah';
                    } elseif ($upperValue === '-' || trim($value) === '-') {
                        return 'tidak ada';
                    }

                    return $value;
                };

                $data = [
                    'nip' => $row[0] ?? null,
                    'nama' => $row[1] ?? null,
                    'drh' => $transformValue($row[2] ?? null),
                    'sk_cpns' => $transformValue($row[3] ?? null),
                    'd2np' => $transformValue($row[4] ?? null),
                    'spmt' => $transformValue($row[5] ?? null),
                    'sk_pns' => $transformValue($row[6] ?? null),
                ];

                // Check if NIP already exists
                $existingDms = Dms::where('nip', $data['nip'])->first();

                if ($existingDms) {
                    // Update existing record
                    $existingDms->update($data);
                    $imported++;
                } else {
                    // Create new record
                    if (!empty($data['nip'])) {
                        Dms::create($data);
                        $imported++;
                    } else {
                        $skipped++;
                    }
                }

                $this->output->progressAdvance();
            }

            $this->output->progressFinish();

            $this->newLine();
            $this->info("Import selesai!");
            $this->info("Total data diproses: " . count($rows));
            $this->info("Data berhasil diimpor/diperbarui: {$imported}");
            $this->info("Data dilewati: {$skipped}");

            return 0;
        } catch (\Exception $e) {
            $this->error("Terjadi kesalahan saat import: " . $e->getMessage());
            return 1;
        }
    }
}
