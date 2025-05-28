<?php include __DIR__ . '/../../layouts/admin/header.php'; ?>

<h2>Edit Event Kuliner</h2>

<div class="container-form-and-lists"> <form action="?route=admin/event/update/<?= $event['id'] ?>" method="POST" class="modern-form"> <label for="title">Nama Event</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($event['title']) ?>" required>

        <label for="event_date">Tanggal</label>
        <input type="date" id="event_date" name="event_date" value="<?= htmlspecialchars($event['event_date']) ?>" required>

        <label for="location">Lokasi</label>
        <input type="text" id="location" name="location" value="<?= htmlspecialchars($event['location']) ?>" required>

        <label for="description">Deskripsi</label>
        <textarea id="description" name="description" rows="5" required><?= htmlspecialchars($event['description']) ?></textarea>

        <div class="form-actions"> <button type="submit" class="button">Update Event</button> <a href="?route=admin/event" class="button-link">Kembali</a> </div>
    </form>
</div>

<?php include __DIR__ . '/../../layouts/admin/footer.php'; ?>