<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Buat 20 buku
        Buku::factory(20)->create();
        // Buat 15 anggota
        Anggota::factory(15)->create();
        // Buat 10 peminjaman
        Peminjaman::factory(10)->create();
        // Update stok buku berdasarkan peminjaman aktif
        $peminjamanAktif = Peminjaman::whereIn('status', ['dipinjam', 'terlambat'])->get();
        foreach ($peminjamanAktif as $pinjam) {
            $buku = Buku::find($pinjam->id_buku);
            if ($buku) {
                $buku->stok -= 1;
                $buku->save();
            }
        }

    }
}
