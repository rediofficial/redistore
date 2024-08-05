<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi</title>
</head>
<body>
    <h1>Notifikasi</h1>

    <?php foreach($notifications as $notification): ?>
        <div>
            <p><?php echo $notification->message; ?></p>
            <small><?php echo $notification->created_at; ?></small>
        </div>
    <?php endforeach; ?>
</body>
</html>
