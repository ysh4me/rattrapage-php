<?php foreach ($errors as $field => $fieldErrors): ?>
    <div>
        <?php foreach ($fieldErrors as $error): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>
