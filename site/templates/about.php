<?php /** @var \Kirby\Cms\Page $page */ ?>

<h1><?= $page->title() ?></h1>

<?php if ($page->blocks()->isNotEmpty()): ?>
  <div class="blocks">
    <?= $page->blocks()->toHtml() ?>
  </div>
<?php endif; ?>

