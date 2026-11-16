<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\StatusPemeriksaan;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\PasienTableSeeder;
use Database\Seeders\RekamMedisSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with complete clinical & administrative data.
     */
    public function run(): void
    {
        // 1. Seed Users (Admin, Dokter, Perawat)
        $this->call(UsersTableSeeder::class);

        // 2. Seed Data Pasien
        $this->call(PasienTableSeeder::class);

        // 3. Seed Rekam Medis / Hasil Pemeriksaan MCU
        $this->call(RekamMedisSeeder::class);

        // 4. Seed Prediksi Hasil Pemeriksaan (Status Kebugaran / Kelayakan Medis Kerja)
        $hasilIds = DB::table('hasil_pemeriksaan')->pluck('id')->toArray();
        $statuses = [
            'Fit to Work',
            'Fit with Note',
            'Fit with Restriction',
            'Temporary Unfit',
            'Fit to Work'
        ];

        foreach ($hasilIds as $index => $id) {
            $statusVal = $statuses[$index % count($statuses)];
            DB::table('prediksi_hasil_pemeriksaan')->updateOrInsert(
                ['id_rekammedis' => $id],
                [
                    'hasil_pemeriksaan' => $statusVal,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            // 5. Seed Status Pemeriksaan (Persetujuan Dokter)
            $persetujuan = ($index % 2 === 0) ? 'Disetujui' : 'Menunggu Persetujuan';
            DB::table('status_pemeriksaan')->updateOrInsert(
                ['id_hasil_pemeriksaan' => $id],
                [
                    'status' => $persetujuan,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            // 6. Seed Rekomendasi Medis Dokter Okupasi
            $diagnoses = [
                'Hipertensi Grade 1 terkontrol, kebugaran kardiovaskular stabil.',
                'Dislipidemia asimtomatik, profil glikemik normal.',
                'Refraksi mata hipermetropia ringan, pendengaran normal.',
                'Riwayat ISPA telah resolusi tuntas, spirometri normal.',
                'Kondisi fisik prima, indikator laboratorium dalam batas normal.'
            ];
            $recommendations = [
                'Disarankan kontrol tensi berkala setiap 3 bulan dan kurangi konsumsi natrium tinggi.',
                'Edukasi diet rendah lemak jenuh dan olahraga aerobik 150 menit per minggu.',
                'Gunakan kacamata koreksi saat bekerja di depan monitor komputer.',
                'Tetap gunakan APD respirator saat bertugas di lingkungan berdebu.',
                'Pertahankan pola hidup sehat dan hidrasi cairan minimal 2 liter per hari.'
            ];

            DB::table('rekomendasi_medis')->updateOrInsert(
                ['hasil_pemeriksaan_id' => $id],
                [
                    'diagnosis' => $diagnoses[$index % count($diagnoses)],
                    'rekomendasi' => $recommendations[$index % count($recommendations)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
