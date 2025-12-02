<?php /** @var \Kirby\Cms\Page $page */ ?>

<h1><?= $page->title() ?></h1>

<?php if ($page->children()->isNotEmpty()): ?>
  <div class="work-items">
    <?php foreach ($page->children()->listed() as $workItem): ?>
      <article class="work-item">
        <h2><?= $workItem->title() ?></h2>
        <?php if ($workItem->text()->isNotEmpty()): ?>
          <div class="work-content">
            <?= $workItem->text()->kirbytext() ?>
          </div>
        <?php endif; ?>
      </article>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

