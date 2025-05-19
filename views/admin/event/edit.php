<?php include __DIR__ . '/../../layouts/admin/header.php'; ?>

<div class="container mt-4">
    <h2>Edit Event Kuliner</h2>
    <form action="?route=admin/event/update/<?= $event['id'] ?>" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Nama Event</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($event['title']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="event_date" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="event_date" name="event_date" value="<?= htmlspecialchars($event['event_date']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Lokasi</label>
            <input type="text" class="form-control" id="location" name="location" value="<?= htmlspecialchars($event['location']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="4" required><?= htmlspecialchars($event['description']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Event</button>
        <a href="?route=admin/event" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include __DIR__ . '/../../layouts/admin/footer.php'; ?>
