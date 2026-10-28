
<?php
$judulHalaman = "Nota Pesanan";
$halamanAktif = "pesanan.php";

$produk = [
    [
        "nama" => "Keyboard Gaming",
        "harga" => 150000,
        "stok" => 10
    ],
    [
        "nama" => "Mouse Gaming",
        "harga" => 75000,
        "stok" => 15
    ],
    [
        "nama" => "Headset Gaming",
        "harga" => 200000,
        "stok" => 8
    ],
    [
        "nama" => "Flashdisk",
        "harga" => 50000,
        "stok" => 20
    ],
    [
        "nama" => "SSD",
        "harga" => 350000,
        "stok" => 5
    ],
    [
        "nama" => "RAM",
        "harga" => 250000,
        "stok" => 7
    ]
];

$namaPembeli = "";
$produkDipilih = "";
$jumlah = 1;
$subtotal = 0;
$diskon = 0;
$total = 0;
$pesan = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $namaPembeli = trim($_POST["nama_pembeli"] ?? "");
    $produkDipilih = $_POST["produk"] ?? "";
    $jumlah = (int) ($_POST["jumlah"] ?? 1);

    if ($namaPembeli === "") {
        $pesan = "Nama pembeli harus diisi.";
    } elseif (
        $produkDipilih === "" ||
        !isset($produk[(int) $produkDipilih]) ||
        (string) (int) $produkDipilih !== (string) $produkDipilih
    ) {
        $pesan = "Silakan pilih produk yang tersedia.";
    } elseif (
        $jumlah < 1 ||
        $jumlah > $produk[(int) $produkDipilih]["stok"]
    ) {
        $pesan = "Jumlah pesanan melebihi stok atau tidak valid.";
    } else {
        $produkDipilih = (int) $produkDipilih;

        $subtotal = $produk[$produkDipilih]["harga"] * $jumlah;

        // Diskon belanja
        if ($subtotal >= 500000) {
            $diskon = $subtotal * 15 / 100;
        } elseif ($subtotal >= 200000) {
            $diskon = $subtotal * 10 / 100;
        }

        $total = $subtotal - $diskon;
        $pesan = "Pesanan berhasil dihitung.";
    }
}

function rupiah($angka) {
    return "Rp " . number_format($angka, 0, ",", ".");
}

include "includes/header.php";
?>

<div class="mb-8">
    <h2 class="text-3xl font-extrabold text-slate-900">
        Nota Pesanan
    </h2>
    <p class="text-slate-500 mt-2">
        Masukkan data pembeli dan pilih produk yang ingin dipesan.
    </p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

    <div class="bg-white rounded-2xl shadow p-6">
        <h3 class="text-xl font-bold mb-5">Form Pemesanan</h3>

        <form method="POST" action="pesanan.php" class="space-y-5">

            <div>
                <label class="block font-semibold mb-2">
                    Nama Pembeli
                </label>
                <input
                    type="text"
                    name="nama_pembeli"
                    value="<?= htmlspecialchars($namaPembeli) ?>"
                    required
                    class="w-full border border-slate-300 rounded-lg p-3"
                    placeholder="Masukkan nama pembeli"
                >
            </div>

            <div>
                <label class="block font-semibold mb-2">
                    Pilih Produk
                </label>
                <select
                    name="produk"
                    required
                    class="w-full border border-slate-300 rounded-lg p-3"
                >
                    <option value="">-- Pilih Produk --</option>

                    <?php foreach ($produk as $i => $item): ?>
                        <option
                            value="<?= $i ?>"
                            <?= (string) $produkDipilih === (string) $i
                                && isset($_POST["produk"])
                                ? "selected" : "" ?>
                        >
                            <?= htmlspecialchars($item["nama"]) ?>
                            - <?= rupiah($item["harga"]) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-2">Jumlah</label>
                <input
                    type="number"
                    name="jumlah"
                    min="1"
                    value="<?= htmlspecialchars((string) $jumlah) ?>"
                    required
                    class="w-full border border-slate-300 rounded-lg p-3"
                >
                <p class="text-sm text-slate-500 mt-1">
                    Stok mengikuti data produk di dalam kode.
                </p>
            </div>

            <button
                type="submit"
                class="w-full bg-orange-500 hover:bg-orange-600
                text-white font-bold py-3 rounded-lg"
            >
                Hitung Pesanan
            </button>

        </form>
    </div>

    <div class="bg-slate-950 text-white rounded-2xl shadow p-6">
        <h3 class="text-xl font-bold mb-5">Ringkasan Pesanan</h3>

        <?php if ($pesan !== ""): ?>
            <p class="mb-5 rounded-lg p-3 <?= $total > 0
                ? 'bg-green-900 text-green-200'
                : 'bg-red-900 text-red-200' ?>">
                <?= htmlspecialchars($pesan) ?>
            </p>
        <?php endif; ?>

        <?php if ($total > 0): ?>
            <div class="space-y-4">

                <div>
                    <p class="text-slate-400 text-sm">Nama Pembeli</p>
                    <p class="font-bold text-lg">
                        <?= htmlspecialchars($namaPembeli) ?>
                    </p>
                </div>

                <div>
                    <p class="text-slate-400 text-sm">Nama Produk</p>
                    <p class="font-bold text-lg">
                        <?= htmlspecialchars($produk[$produkDipilih]["nama"]) ?>
                    </p>
                </div>

                <div>
                    <p class="text-slate-400 text-sm">Harga Satuan</p>
                    <p><?= rupiah($produk[$produkDipilih]["harga"]) ?></p>
                </div>

                <div>
                    <p class="text-slate-400 text-sm">Jumlah</p>
                    <p><?= $jumlah ?> unit</p>
                </div>

                <div class="border-t border-slate-700 pt-4 space-y-3">
                    <div class="flex justify-between gap-4">
                        <span class="text-slate-400">Subtotal</span>
                        <span><?= rupiah($subtotal) ?></span>
                    </div>

                    <div class="flex justify-between gap-4">
                        <span class="text-slate-400">Diskon</span>
                        <span class="text-green-400">
                            - <?= rupiah($diskon) ?>
                        </span>
                    </div>

                    <div class="flex justify-between gap-4">
                        <span class="text-slate-400">Total Pembayaran</span>
                        <span class="text-orange-400 font-extrabold text-xl">
                            <?= rupiah($total) ?>
                        </span>
                    </div>
                </div>

            </div>
        <?php else: ?>
            <p class="text-slate-400">
                Ringkasan pesanan akan muncul setelah kamu mengisi
                form dan menekan tombol Hitung Pesanan.
            </p>
        <?php endif; ?>
    </div>

</div>

<?php include "includes/footer.php"; ?>
