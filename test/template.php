<!doctype html>
<head>
    <title>QuickView</title>
</head>

<body>
    <div <?= $_attrs(['class' => 'classname']) ?>>
        Created by <?= $name ?><<?= $mail ?>>
    </div>
    <?= $_draw('drawable.php') ?>

    <div>
        Icon: <?= $_draw('icon.svg') ?>
    </div>
</body>