<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pegawai;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportPegawaiFromExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pegawai:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Pegawai data from Excel file (public/excel/Data_Januari_2026.xlsx) to Pegawai table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = public_path('excel/Data_Januari_2026.xlsx');

        // Check if file exists
        if (!file_exists($filePath)) {
            $this->error("File tidak ditemukan: {$filePath}");
            return 1;
        }

        $this->info("Memulai import data Pegawai dari: {$filePath}");

        try {
            // Load the Excel file
            $spreadsheet = IOFactory::load($filePath);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            // Remove header row (start from row 2)
            array_shift($rows);

            $imported = 0;
            $updated = 0;
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
                // A=0: nip, B=1: nama, C=2: gelar_depan, D=3: gelar_belakang,
                // F=5: gol_pangkat, K=10: ket_jabatan, O=14: kode_skpd

                $data = [
                    'nip' => trim($row[0] ?? ''),
                    'nama' => trim($row[1] ?? ''),
                    'gelar_depan' => trim($row[2] ?? ''),
                    'gelar_belakang' => trim($row[3] ?? ''),
                    'status_pegawai' => 'PNS', // Default value
                    'gol_pangkat' => trim($row[5] ?? ''),
                    'ket_jabatan' => trim($row[10] ?? ''),
                    'kode_skpd' => trim($row[14] ?? ''),
                ];

                // Skip if NIP is empty
                if (empty($data['nip'])) {
                    $skipped++;
                    $this->output->progressAdvance();
                    continue;
                }

                // Check if NIP already exists
                $existingPegawai = Pegawai::where('nip', $data['nip'])->first();

                if ($existingPegawai) {
                    // Update existing record (exclude NIP from update)
                    $updateData = $data;
                    unset($updateData['nip']);
                    $existingPegawai->update($updateData);
                    $updated++;
                    $this->line("  - Memperbarui data: {$data['nip']} - {$data['nama']}");
                } else {
                    // Create new record
                    Pegawai::create($data);
                    $imported++;
                    $this->line("  - Menambahkan data baru: {$data['nip']} - {$data['nama']}");
                }

                $this->output->progressAdvance();
            }

            $this->output->progressFinish();

            $this->newLine();
            $this->info("========================================");
            $this->info("Import selesai!");
            $this->info("========================================");
            $this->info("Total data diproses: " . count($rows));
            $this->info("Data baru ditambahkan: {$imported}");
            $this->info("Data diperbarui: {$updated}");
            $this->info("Data dilewati: {$skipped}");
            $this->info("========================================");

            return 0;
        } catch (\Exception $e) {
            $this->error("Terjadi kesalahan saat import: " . $e->getMessage());
            $this->error("Stack trace: " . $e->getTraceAsString());
            return 1;
        }
    }
}