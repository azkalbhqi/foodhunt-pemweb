<?php
require_once __DIR__ . '/../models/Event.php';

class EventController {
    private function IsAdmin() {
        session_start(); // pastikan session aktif
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            die('Akses ditolak. Halaman ini hanya untuk admin.');
        }
    }
    // Tampilkan daftar event untuk admin
    public function index() {
        $events = Event::all();

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            include __DIR__ . '/../views/user/event/index.php';
        }else{

            include __DIR__ . '/../views/admin/event/index.php';
        }
    }

    // Tampilkan form tambah event
    public function create() {
        $this->IsAdmin();
        include __DIR__ . '/../views/admin/event/create.php';
    }

    // Proses simpan event baru
    public function store() {
        $this->IsAdmin();
        $data = [
            'title' => $_POST['title'] ?? '',
            'event_date' => $_POST['event_date'] ?? '',
            'location' => $_POST['location'] ?? '',
            'description' => $_POST['description'] ?? '',
        ];

        // Validasi dasar
        if (empty($data['title']) || empty($data['event_date']) || empty($data['location']) || empty($data['description'])) {
            die('Semua field wajib diisi.');
        }

        Event::create($data);
        header('Location: ?route=admin/event');
        exit;
    }

    // Tampilkan form edit event
    public function edit($id) {
        $this->IsAdmin();
        $event = Event::find($id);
        if (!$event) {
            die('Event tidak ditemukan.');
        }
        include __DIR__ . '/../views/admin/event/edit.php';
    }

    // Proses update event
    public function update($id) {
        $this->IsAdmin();
        // Cek apakah form sudah disubmit
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'] ?? '',
                'event_date' => $_POST['event_date'] ?? '',
                'location' => $_POST['location'] ?? '',
                'description' => $_POST['description'] ?? '',
            ];
    
            // Validasi dasar
            if (empty($data['title']) || empty($data['event_date']) || empty($data['location']) || empty($data['description'])) {
                var_dump($data);
                die('Semua field wajib diisi.');
            }
    
            Event::update($id, $data);
            header('Location: ?route=admin/event');
            exit;
        } else {
            die('Invalid request method.');
        }
    }
    

    // Tampilkan daftar event untuk user
    public function userIndex() {
        $events = Event::all();
        include __DIR__ . '/../views/user/event/index.php';
    }

    // Tampilkan detail event ke user
    public function userShow($id) {
        $event = Event::find($id);
        if (!$event) {
            die('Event tidak ditemukan.');
        }
        include __DIR__ . '/../views/user/event/show.php';
    }
}
