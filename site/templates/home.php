
<?php snippet('header'); ?>
<main id="main-content">
    <section>
        <div class="container primaryMenuToggler cursor-pointer">
            <h1 class="sr-only">
                Lars Borges
            </h1>
            <div class="h-[calc(100dvh-116px)] xl:h-[calc(100dvh-148px)] flex items-center justify-center">
                <?php
                // Get all work-post pages with cover images
                $workPages = $site->find('work')?->children()->template('work-post')->filter(function($page) {
                    return $page->work_cover()->toFile() !== null;
                });
                
                // Get random cover image
                $randomImage = null;
                if ($workPages && $workPages->count() > 0) {
                    $randomPage = $workPages->shuffle()->first();
                    $randomImage = $randomPage->work_cover()->toFile();
                }
                ?>
                <?php if ($randomImage): ?>
                    <img loading="lazy" 
                         src="<?= $randomImage->url() ?>" 
                         alt="<?= $randomImage->alt()->or($randomPage->title()) ?>"
                         class="size-full object-contain" 
                         fetchpriority="high" 
                         id="randomImage">
                <?php else: ?>
                    <img loading="lazy" 
                         src="<?= url('assets/images/image-9.webp') ?>" 
                         alt="Random picture from gallery"
                         class="size-full object-contain" 
                         fetchpriority="high" 
                         id="randomImage">
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>
<?php snippet('footer'); ?>