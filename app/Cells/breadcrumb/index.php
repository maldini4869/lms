<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-4">
        <?php foreach ($breadcrumbs as $index => $breadcrumb) : ?>
            <?php if ($index !== array_key_last($breadcrumbs)) : ?>
                <li class="breadcrumb-item"><a href="<?= $breadcrumb['link']; ?>"><?= $breadcrumb['label']; ?></a></li>
            <?php else : ?>
                <li class="breadcrumb-item active" aria-current="page"><?= $breadcrumb['label']; ?></li>
            <?php endif ?>
        <?php endforeach; ?>
    </ol>
</nav>