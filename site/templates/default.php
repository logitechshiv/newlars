<?php snippet('header'); ?>
<main id="main-content">

<?php /** @var \Kirby\Cms\Page $page */ ?>

<section class="min-h-[calc(100dvh-116px)] xl:min-h-[calc(100dvh-148px)]">
  <div class="container xl:px-32 py-16">
      <div class="flex flex-col xl:flex-row gap-30">
          <div class="sticky top-0 w-full xl:max-w-256 px-16 xl:p-0">
              <div
                  class="flex flex-wrap gap-x-24 gap-y-6 not-xl:items-end not-xl:justify-between xl:flex-col sticky top-80">
                  <h1 class="text-h1 xxl:text-[66px] xxl:leading-[66px] xl:mb-12 xxl:mb-24">
                    <?= $page->title() ?>
                  </h1>
                  <ul class="text-[15px] flex flex-wrap xl:flex-col gap-x-30">
                      <li>
                          <a href="tel:<?= $site->phone() ?>" class="animated_link">
                            <?= $site->phone() ?>
                          </a>
                      </li>
                      <li>
                          <a href="mailto:<?= $site->email() ?>" class="animated_link">
                            <?= $site->email() ?>
                          </a>
                      </li>
                  </ul>
              </div>
          </div>
          <div class="w-full xxl:max-w-1024 px-16 xl:p-0">
              <div class="mixed_content">
              <?php if ($page->about_blocks()->isNotEmpty()): ?>
                  <?= $page->about_blocks()->toBlocks()->toHtml() ?>
              <?php endif; ?>
              </div>
          </div>
      </div>
  </div>
</section>
</main>
<?php snippet('footer'); ?>
