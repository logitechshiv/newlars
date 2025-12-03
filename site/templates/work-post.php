<?php snippet('header'); ?>
<main id="main-content">
    <section>
        <div class="container xl:px-32 py-16">
            <div class="flex flex-col xl:flex-row gap-30">
                <div class="sticky top-0 w-full xl:max-w-256 px-16 xl:p-0">
                    <?php $workPage = $page->parent(); ?>
                    <?php if ($workPage): ?>
                        <a href="<?= $workPage->url() ?>" class="!flex items-center gap-4 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M15 6l-6 6l6 6" />
                            </svg>
                            <span><?= $workPage->title() ?></span>
                        </a>
                    <?php endif; ?>
                    <h1 class="text-h1 lg:text-[44px] lg:leading-[44px] mb-4 xl:mb-8">
                        <?= $page->title() ?>
                    </h1>
                    <?php if ($page->work_description()->isNotEmpty()): ?>
                        <div class="work-description">
                            <?= $page->work_description()->kirbytext() ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="w-full xxl:max-w-1024 flex flex-col gap-32" id="work-post-gallery-container">
                    <?php
                    // Display cover (image/video/youtube)
                    $coverType = $page->work_coverType()->value() ?: 'image';
                    ?>
                    
                    <?php if ($coverType === 'image' && $page->work_coverimage()->toFile()): ?>
                        <?php $coverImage = $page->work_coverimage()->toFile(); ?>
                        <div class="gallery-item image pb-16 xl:pb-32 last-of-type:pb-0 w-full sticky top-0 bg-white">
                            <img loading="lazy" 
                                 src="<?= $coverImage->url() ?>" 
                                 alt="<?= $coverImage->alt()->or($page->title()) ?>"
                                 class="w-full mb-12">
                        </div>
                    <?php elseif ($coverType === 'video' && $page->work_coverVideo()->toFile()): ?>
                        <?php $coverVideo = $page->work_coverVideo()->toFile(); ?>
                        <div class="gallery-item video pb-16 xl:pb-32 last-of-type:pb-0 w-full sticky top-0 bg-white">
                            <video class="w-full mb-12" 
                                   controls 
                                   muted 
                                   playsinline
                                   preload="metadata">
                                <source src="<?= $coverVideo->url() ?>" type="<?= $coverVideo->mime() ?>">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    <?php elseif ($coverType === 'youtube' && $page->work_coverYoutube()->isNotEmpty()): ?>
                        <?php 
                        $youtubeUrl = $page->work_coverYoutube()->value();
                        $youtubeEmbed = youtubePrivacy($youtubeUrl, ['modestbranding' => 1, 'rel' => 0], [
                            'style' => 'position: absolute; top: 0; left: 0; width: 100%; height: 100%;',
                            'loading' => 'lazy'
                        ]);
                        ?>
                        <?php if ($youtubeEmbed): ?>
                            <div class="gallery-item youtube pb-16 xl:pb-32 last-of-type:pb-0 w-full sticky top-0 bg-white">
                                <div class="video-wrapper mb-12" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                                    <?= $youtubeEmbed ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php
                    // Display gallery with lazy loading (similar to diary.php)
                    $gallery = $page->work_gallery()->toStructure();
                    $itemsPerPage = 4; // Initial items to load
                    $itemIndex = 0;
                    
                    foreach ($gallery as $item):
                        $itemType = $item->work_itemType()->value();
                        $itemIndex++;
                        $lazyClass = $itemIndex > $itemsPerPage ? 'lazy-load' : '';
                    ?>
                        <?php if ($itemType === 'image' && $item->work_image()->toFile()): ?>
                            <?php $image = $item->work_image()->toFile(); ?>
                            <div class="gallery-item image pb-16 xl:pb-32 last-of-type:pb-0 w-full sticky top-0 bg-white <?= $lazyClass ?>" 
                                 data-type="image" 
                                 <?= $lazyClass ? 'data-src="' . $image->url() . '" data-alt="' . htmlspecialchars($image->alt()->or($page->title())->value()) . '"' : '' ?>>
                                <?php if (!$lazyClass): ?>
                                    <img loading="lazy" 
                                         src="<?= $image->url() ?>" 
                                         alt="<?= $image->alt()->or($page->title()) ?>"
                                         class="w-full mb-12">
                                <?php endif; ?>
                            </div>
                        <?php elseif ($itemType === 'video' && $item->work_video()->toFile()): ?>
                            <?php $video = $item->work_video()->toFile(); ?>
                            <div class="gallery-item video pb-16 xl:pb-32 last-of-type:pb-0 w-full sticky top-0 bg-white <?= $lazyClass ?>" 
                                 data-type="video" 
                                 <?= $lazyClass ? 'data-src="' . $video->url() . '" data-mime="' . $video->mime() . '"' : '' ?>>
                                <?php if (!$lazyClass): ?>
                                    <video class="w-full mb-12" 
                                           controls 
                                           muted 
                                           playsinline
                                           preload="metadata">
                                        <source src="<?= $video->url() ?>" type="<?= $video->mime() ?>">
                                        Your browser does not support the video tag.
                                    </video>
                                <?php endif; ?>
                            </div>
                        <?php elseif ($itemType === 'youtube' && $item->work_youtubeUrl()->isNotEmpty()): ?>
                            <?php 
                            $youtubeUrl = $item->work_youtubeUrl()->value();
                            $youtubeEmbed = youtubePrivacy($youtubeUrl, ['modestbranding' => 1, 'rel' => 0], [
                                'style' => 'position: absolute; top: 0; left: 0; width: 100%; height: 100%;',
                                'loading' => 'lazy'
                            ]);
                            ?>
                            <?php if ($youtubeEmbed): ?>
                                <div class="gallery-item youtube pb-16 xl:pb-32 last-of-type:pb-0 w-full sticky top-0 bg-white <?= $lazyClass ?>" 
                                     data-type="youtube" 
                                     <?= $lazyClass ? 'data-youtube-url="' . htmlspecialchars($youtubeUrl, ENT_QUOTES, 'UTF-8') . '"' : '' ?>>
                                    <?php if (!$lazyClass): ?>
                                        <div class="video-wrapper mb-12" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
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

