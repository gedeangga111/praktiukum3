
<?php

// Mengubah angka menjadi format Rupiah
function formatRupiah(float $angka): string
{
    return "Rp " . number_format($angka, 0, ',', '.');
}

// Menghitung harga setelah diskon
function hargaSetelahDiskon(int $harga, int $persenDiskon = 0): int
{
    $potongan = $harga * $persenDiskon / 100;
    return (int) round($harga - $potongan);
}

// Menentukan status stok produk
function labelStok(int $stok): string
{
    return match (true) {
        $stok === 0 => "Habis",
        $stok < 5 => "Sisa $stok",
        default => "Tersedia",
    };
}

// Menentukan warna status stok
function warnaStok(int $stok): string
{
    return match (true) {
        $stok === 0 => "bg-red-100 text-red-700",
        $stok < 5 => "bg-amber-100 text-amber-700",
        default => "bg-green-100 text-green-700",
    };
}

// Menghitung nilai seluruh stok setelah diskon
function hitungNilaiStok(array $daftarProduk): int
{
    $total = 0;

    foreach ($daftarProduk as $item) {
        $total += hargaSetelahDiskon(
            $item["harga"],
            $item["diskon"]
        ) * $item["stok"];
    }

    return $total;
}

// Menghitung jumlah produk yang mendapat diskon
function hitungProdukDiskon(array $daftarProduk): int
{
    $jumlah = 0;

    foreach ($daftarProduk as $item) {
        if ($item["diskon"] > 0) {
            $jumlah++;
        }
    }

    return $jumlah;
}

// Menghitung diskon berdasarkan total belanja
function diskonBelanja(int $totalBelanja): int
{
    $persen = match (true) {
        $totalBelanja >= 500000 => 15,
        $totalBelanja >= 200000 => 10,
        default => 0,
    };

    return (int) round($totalBelanja * $persen / 100);
}
