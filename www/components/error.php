<?php if (isset($errors) && count($errors) > 0): ?>
    <div class="error-container">
        <?php foreach ($errors as $error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>