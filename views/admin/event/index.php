<?php include __DIR__ . '/../../layouts/admin/header.php'; ?>

<h2>Daftar Event Kuliner</h2>

<div class="actions">
    <a href="?route=admin/event/create" class="btn-primary">+ Tambah Event</a>
</div>

<div class="table-wrapper">
    <table class="styled-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event): ?>
                <tr>
                    <td><?= htmlspecialchars($event['title']) ?></td>
                    <td><?= date('d-m-Y', strtotime($event['event_date'])) ?></td>
                    <td><?= htmlspecialchars($event['location']) ?></td>
                    <td><?= htmlspecialchars($event['description']) ?></td>
                    <td>
                        <a href="?route=admin/event/edit/<?= $event['id'] ?>" class="btn-action edit">Edit</a>
                        <a href="?route=admin/event/delete/<?= $event['id'] ?>" class="btn-action delete" onclick="return confirm('Yakin?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../../layouts/admin/footer.php'; ?>
