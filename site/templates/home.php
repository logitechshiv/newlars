
<?php snippet('header'); ?>
<main id="main-content">
    <section>
        <div class="container primaryMenuToggler cursor-pointer">
            <h1 class="sr-only">
                Lars Borges
            </h1>
            <div class="h-[calc(100dvh-131px)] xl:h-[calc(100dvh-150px)] flex items-center justify-center">
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
                    <img
                        src="<?= $randomImage->thumb(['width' => 1500])->url() ?>"
                        srcset="
                        <?= $randomImage->thumb(['width' => 300])->url() ?> 300w,
                        <?= $randomImage->thumb(['width' => 600])->url() ?> 600w,
                        <?= $randomImage->thumb(['width' => 900])->url() ?> 900w,
                        <?= $randomImage->thumb(['width' => 1200])->url() ?> 1200w,
                        <?= $randomImage->thumb(['width' => 1500])->url() ?> 1500w
                        "
                        sizes="100vw"
                        width="<?= $randomImage->width() ?>"
                        height="<?= $randomImage->height() ?>"
                        loading="lazy"
                        fetchpriority="high"
                        alt="<?= $randomImage->alt()->or($randomPage->title()) ?>"
                        class="size-full object-contain"  
                    />
                <?php else: ?>
                    <img 
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