<?php snippet('header'); ?>
<main id="main-content">
<section>
    <div class="container xl:px-32 py-16">
        <div class="flex flex-col xl:flex-row gap-30">
            <div class="sticky top-0 w-full xl:max-w-256 px-16 xl:p-0">
                <div
                    class="flex flex-wrap gap-x-24 gap-y-6 not-xl:items-end not-xl:justify-between xl:flex-col sticky top-80">
                    <h1 class="text-h1 xxl:text-[66px] xxl:leading-[66px] xl:mb-12 xxl:mb-24">
                        <?= $page->title() ?>
                    </h1>
                </div>
            </div>
            <div class="w-full max-w-1024 flex flex-col gap-32" id="gallery-container">
                <?php 
                $gallery = $page->journal_gallery()->toStructure();
                $itemsPerPage = 4; // Initial items to load
                $itemIndex = 0;
                
                foreach ($gallery as $item):
                    $itemType = $item->journal_itemType()->value();
                    $itemIndex++;
                    $lazyClass = $itemIndex > $itemsPerPage ? 'lazy-load' : '';
                ?>
                    <?php if ($itemType === 'image' && $item->journal_image()->toFile()): ?>
                        <?php $image = $item->journal_image()->toFile(); ?>
                        <div class="gallery-item image <?= $lazyClass ?>" data-type="image" <?= $lazyClass ? 'data-src="' . $image->url() . '"' : '' ?>>
                            <?php if (!$lazyClass): ?>
                                <img loading="lazy" 
                                     src="<?= $image->url() ?>" 
                                     alt="<?= $image->alt()->or($page->title()) ?>"
                                     class="w-full">
                            <?php endif; ?>
                        </div>
                    <?php elseif ($itemType === 'video' && $item->journal_video()->toFile()): ?>
                        <?php $video = $item->journal_video()->toFile(); ?>
                        <div class="gallery-item video <?= $lazyClass ?>" data-type="video" <?= $lazyClass ? 'data-src="' . $video->url() . '"' : '' ?>>
                            <?php if (!$lazyClass): ?>
                                <video class="w-full" 
                                       controls 
                                       muted 
                                       playsinline
                                       preload="metadata"
                                       data-video-src="<?= $video->url() ?>">
                                    <source src="<?= $video->url() ?>" type="<?= $video->mime() ?>">
                                    Your browser does not support the video tag.
                                </video>
                            <?php endif; ?>
                        </div>
                    <?php elseif ($itemType === 'youtube' && $item->journal_youtubeUrl()->isNotEmpty()): ?>
                        <?php 
                        $youtubeUrl = $item->journal_youtubeUrl()->value();
                        // Use privacy-enhanced YouTube embed (reduces console errors)
                        $youtubeEmbed = youtubePrivacy($youtubeUrl, ['modestbranding' => 1, 'rel' => 0], [
                            'style' => 'position: absolute; top: 0; left: 0; width: 100%; height: 100%;',
                            'loading' => 'lazy'
                        ]);
                        ?>
                        <?php if ($youtubeEmbed): ?>
                            <div class="gallery-item youtube <?= $lazyClass ?>" data-type="youtube" <?= $lazyClass ? 'data-youtube-url="' . htmlspecialchars($youtubeUrl) . '"' : '' ?>>
                                <?php if (!$lazyClass): ?>
                                    <div class="video-wrapper" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                                        <?= $youtubeEmbed ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
</main>
<?php snippet('footer'); ?>