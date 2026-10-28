
    </main>

    <footer class="bg-slate-950 text-slate-300 mt-10">
        <div class="max-w-6xl mx-auto px-5 py-8">

            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-center md:text-left">
                    <h2 class="text-lg font-extrabold text-white">
                        <span class="text-orange-500">A</span>
                        <?= htmlspecialchars($namaToko) ?>
                    </h2>
                    <p class="text-sm text-slate-400 mt-1">
                        Your Everyday Tech Partner
                    </p>
                </div>

                <div class="text-center md:text-right text-sm">
                    <p>Praktikum 3 - Pemrograman Web</p>
                    <p class="text-slate-500 mt-1">
                        Array, Fungsi, dan Include
                    </p>
                </div>
            </div>

            <div class="border-t border-slate-800 mt-6 pt-5 text-center text-xs text-slate-500">
                &copy; <?= date('Y') ?> <?= htmlspecialchars($namaToko) ?>.
                All Rights Reserved.
            </div>

        </div>
    </footer>

</body>
</html>
