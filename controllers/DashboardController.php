<?php
// app/controllers/DashboardController.php

// Pastikan path ke model-model Anda benar
require_once __DIR__ . '/../models/Bundling.php';
require_once __DIR__ . '/../models/Food.php';
require_once __DIR__ . '/../models/Event.php';

class DashboardController {

    /**
     * Menampilkan halaman dashboard admin dengan ringkasan data.
     * Metode ini langsung meng-include view.
     */
    public function adminIndex() {
        // Mengambil total data dari masing-masing model menggunakan metode statis
        $totalBundles = Bundling::getTotalBundles();
        $totalFoods = Food::getTotalFoods();
        $totalEvents = Event::getTotalEvents();

        // Judul halaman untuk header layout (jika diperlukan)
        $headTitles = "Dashboard Admin";

        include __DIR__ . '/../views/admin/dashboard/index.php';
    }
}