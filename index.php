
<?php
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/fungsi.php';

$judulHalaman = "Katalog Produk";
$halamanAktif = "index.php";

$jumlahProduk = count($produk);
$jumlahDiskon = hitungProdukDiskon($produk);
$nilaiStok = hitungNilaiStok($produk);

require __DIR__ . '/includes/header.php';
?>

<section class="bg-slate-900 text-white rounded-2xl p-7 md:p-10 mb-8">
    <p class="text-orange-400 font-bold text-sm uppercase tracking-widest mb-3">
        WELCOME TO ANGGA TECH STORE
    </p>

    <h2 class="text-3xl md:text-5xl font-black leading-tight mb-4">
        Upgrade Your <span class="text-orange-400">Digital Life.</span>
    </h2>

    <p class="text-slate-300 leading-relaxed mb-6">
        Temukan perlengkapan teknologi pilihan untuk belajar,
        bekerja, dan hiburan sehari-hari.
    </p>

    <a href="#daftar-produk"
       class="inline-block bg-orange-500 hover:bg-orange-400 text-slate-950 font-bold px-5 py-3 rounded-lg">
        Jelajahi Produk ↓
    </a>
</section>

<section class="mb-6">
    <p class="text-orange-600 font-bold text-sm uppercase tracking-wider">
        Pilihan untukmu
    </p>
    <h2 class="text-2xl md:text-3xl font-black text-slate-900 mt-1">
        Katalog Produk
    </h2>
    <p class="text-slate-500 mt-2">
        Pilih perlengkapan teknologi favoritmu.
    </p>
</section>

<section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-10">

    <div class="bg-white rounded-xl border p-5 shadow-sm">
        <p class="text-slate-500 text-sm">Total Produk</p>
        <p class="text-3xl font-black mt-3"><?= $jumlahProduk ?></p>
        <p class="text-xs text-slate-400 mt-1">Produk dalam katalog</p>
    </div>

    <div class="bg-white rounded-xl border p-5 shadow-sm">
        <p class="text-slate-500 text-sm">Produk Diskon</p>
        <p class="text-3xl font-black text-orange-600 mt-3"><?= $jumlahDiskon ?></p>
        <p class="text-xs text-slate-400 mt-1">Harga spesial</p>
    </div>

    <div class="bg-white rounded-xl border p-5 shadow-sm">
        <p class="text-slate-500 text-sm">Nilai Total Stok</p>
        <p class="text-2xl font-black mt-3"><?= formatRupiah($nilaiStok) ?></p>
        <p class="text-xs text-slate-400 mt-1">Setelah diskon produk</p>
    </div>

</section>

<section id="daftar-produk">
    <h2 class="text-2xl font-black text-slate-900 mb-5">
        Produk Pilihan
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php foreach ($produk as $kode => $item): ?>
            <?php
            $hargaAkhir = hargaSetelahDiskon(
                $item["harga"],
                $item["diskon"]
            );
            ?>

            <article class="bg-white rounded-2xl overflow-hidden border shadow-sm hover:shadow-xl transition">

                <div class="bg-slate-900 h-44 flex items-center justify-center relative">
                    <span class="text-7xl">
                        <?= htmlspecialchars($item["ikon"]) ?>
                    </span>

                    <?php if ($item["diskon"] > 0): ?>
                        <span class="absolute top-4 left-4 bg-orange-500 text-slate-950 text-sm font-black px-3 py-1 rounded-full">
                            -<?= $item["diskon"] ?>%
                        </span>
                    <?php endif; ?>

                    <span class="absolute top-4 right-4 text-xs text-white">
                        <?= htmlspecialchars($kode) ?>
                    </span>
                </div>

                <div class="p-5">
                    <p class="text-xs font-bold uppercase text-orange-600 mb-2">
                        <?= htmlspecialchars($item["kategori"]) ?>
                    </p>

                    <h3 class="text-lg font-extrabold text-slate-900">
                        <?= htmlspecialchars($item["nama"]) ?>
                    </h3>

                    <div class="mt-3 mb-4">
                        <?php if ($item["diskon"] > 0): ?>
                            <p class="text-sm text-slate-400 line-through">
                                <?= formatRupiah($item["harga"]) ?>
                            </p>
                        <?php endif; ?>

                        <p class="text-2xl font-black">
                            <?= formatRupiah($hargaAkhir) ?>
                        </p>
                    </div>

                    <div class="border-t pt-4 flex justify-between items-center gap-2">
                        <span class="text-xs text-slate-500">Status stok</span>

                        <span class="text-xs font-bold px-3 py-2 rounded-full <?= warnaStok($item["stok"]) ?>">
                            <?= labelStok($item["stok"]) ?>
                        </span>
                    </div>
                </div>

            </article>
        <?php endforeach; ?>

    </div>
</section>

<section class="mt-10 bg-orange-50 border border-orange-200 rounded-xl p-5">
    <h3 class="font-extrabold text-slate-900 mb-1">
        Belanja Teknologi Lebih Mudah
    </h3>
    <p class="text-sm text-slate-600">
        ANGGA TECH STORE menyediakan aksesoris dan perangkat
        elektronik untuk kebutuhan sehari-hari.
    </p>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
