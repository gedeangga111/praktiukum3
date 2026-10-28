
<?php
if (!isset($judulHalaman)) {
    $judulHalaman = "ANGGA TECH STORE";
}

if (!isset($halamanAktif)) {
    $halamanAktif = "index.php";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($judulHalaman) ?> | ANGGA TECH STORE</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        toko: {
                            gelap: '#0f172a',
                            oranye: '#f97316'
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-slate-50 text-slate-800 min-h-screen">

<header class="bg-slate-950 text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-5 py-5">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

            <a href="index.php" class="flex items-center gap-3">
                <div class="bg-orange-500 text-white font-extrabold text-2xl rounded-xl w-12 h-12 flex items-center justify-center">
                    A
                </div>

                <div>
                    <h1 class="text-xl md:text-2xl font-extrabold tracking-wide">
                        ANGGA <span class="text-orange-500">TECH STORE</span>
                    </h1>

                    <p class="text-slate-400 text-xs mt-1">
                        Toko Elektronik Pilihan Anda
                    </p>
                </div>
            </a>

            <nav class="flex flex-wrap items-center gap-3">

                <a
                    href="index.php"
                    class="px-4 py-2 rounded-lg font-semibold transition
                    <?= $halamanAktif === 'index.php'
                        ? 'bg-orange-500 text-white'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' ?>"
                >
                    Katalog Produk
                </a>

                <a
                    href="pesanan.php"
                    class="px-4 py-2 rounded-lg font-semibold transition
                    <?= $halamanAktif === 'pesanan.php'
                        ? 'bg-orange-500 text-white'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' ?>"
                >
                    Nota Pesanan
                </a>

            </nav>

        </div>

    </div>
</header>

<main class="max-w-7xl mx-auto px-5 py-8">
