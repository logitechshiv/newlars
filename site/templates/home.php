
<?php snippet('header'); ?>
<main id="main-content">
    <section>
        <div class="container primaryMenuToggler cursor-pointer">
            <h1 class="sr-only">
                Lars Borges
            </h1>
            <div class="h-[calc(100dvh-116px)] xl:h-[calc(100dvh-148px)] flex items-center justify-center">
                <?php
                // Get all work-post pages with cover images (prioritize images for home page)
                $workPages = $site->find('work')?->children()->template('work-post')->filter(function($page) {
                    $coverType = $page->work_coverType()->value() ?: 'image';
                    if ($coverType === 'image') {
                        return $page->work_coverimage()->toFile() !== null;
                    }
                    return false; // Only show images on home page
                });
                
                // Get random cover image - ensure different image on each refresh
                $randomImage = null;
                $randomPage = null;
                if ($workPages && $workPages->count() > 0) {
                    // Use random() method which properly randomizes each time
                    $randomPage = $workPages->random(1)->first();
                    if ($randomPage) {
                        $randomImage = $randomPage->work_coverimage()->toFile();
                    }
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