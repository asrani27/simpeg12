<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Dms;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UpdateSpmtFromExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dms:update-spmt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update SPMT field to null for NIPs listed in Excel file (public/excel/spmt_update.xlsx)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = public_path('excel/spmt_update.xlsx');

        // Check if file exists
        if (!file_exists($filePath)) {
            $this->error("File tidak ditemukan: {$filePath}");
            return 1;
        }

        $this->info("Memulai update field SPMT dari: {$filePath}");

        try {
            // Load the Excel file
            $spreadsheet = IOFactory::load($filePath);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            // Remove header row (start from row 2)
            array_shift($rows);

            $updated = 0;
            $notFound = 0;
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

                // Get NIP from column A (index 0)
                $nip = $row[0] ?? null;

                // Skip if NIP is empty
                if (empty($nip)) {
                    $skipped++;
                    $this->output->progressAdvance();
                    continue;
                }

                // Clean NIP (remove spaces and convert to string)
                $nip = trim((string)$nip);

                // Find Dms record by NIP
                $dms = Dms::where('nip', $nip)->first();

                if ($dms) {
                    // Update spmt field to null
                    $dms->update(['spmt' => null]);
                    $updated++;
                } else {
                    $notFound++;
                }

                $this->output->progressAdvance();
            }

            $this->output->progressFinish();

            $this->newLine();
            $this->info("Update selesai!");
            $this->info("Total baris diproses: " . count($rows));
            $this->info("Data berhasil diupdate: {$updated}");
            $this->info("NIP tidak ditemukan: {$notFound}");
            $this->info("Baris dilewati (kosong): {$skipped}");

            return 0;
        } catch (\Exception $e) {
            $this->error("Terjadi kesalahan saat update: " . $e->getMessage());
            return 1;
        }
    }
}