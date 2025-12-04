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
                    <div class="w-full xxl:max-w-1024" id="work-gallery-container">
                        <?php 
                        // Display work posts in panel order (clients can reorder in backend)
                        $workPosts = $page->children()->listed()->sortBy('num', 'asc');
                        $itemsPerPage = 4; // Initial items to load
                        $itemIndex = 0;
                        
                        foreach ($workPosts as $workPost):
                            $itemIndex++;
                            $lazyClass = $itemIndex > $itemsPerPage ? 'lazy-load' : '';
                            $coverType = $workPost->work_coverType()->value() ?: 'image';
                        ?>
                            <a href="<?= $workPost->url() ?>"
                                class="pb-32 xl:pb-64 last-of-type:pb-0 w-full sticky top-0 bg-white work-item <?= $lazyClass ?>"
                                data-type="<?= $coverType ?>"
                                <?php if ($lazyClass): ?>
                                    <?php if ($coverType === 'image' && $workPost->work_coverimage()->toFile()): ?>
                                        data-src="<?= $workPost->work_coverimage()->toFile()->url() ?>"
                                        data-alt="<?= htmlspecialchars($workPost->work_coverimage()->toFile()->alt()->or($workPost->title())->value()) ?>"
                                    <?php elseif ($coverType === 'video' && $workPost->work_coverVideo()->toFile()): ?>
                                        data-src="<?= $workPost->work_coverVideo()->toFile()->url() ?>"
                                        data-mime="<?= $workPost->work_coverVideo()->toFile()->mime() ?>"
                                    <?php elseif ($coverType === 'youtube' && $workPost->work_coverYoutube()->isNotEmpty()): ?>
                                        data-youtube-url="<?= htmlspecialchars($workPost->work_coverYoutube()->value(), ENT_QUOTES, 'UTF-8') ?>"
                                    <?php endif; ?>
                                <?php endif; ?>>
                                
                                <div class="work-cover mb-12">
                                    <?php if (!$lazyClass): ?>
                                        <?php if ($coverType === 'image' && $workPost->work_coverimage()->toFile()): ?>
                                            <?php $coverImage = $workPost->work_coverimage()->toFile(); ?>
                                           
                                                 <img
                                                    src="<?= $coverImage->thumb(['width' => 1500])->url() ?>"
                                                    srcset="
                                                    <?= $coverImage->thumb(['width' => 300])->url() ?> 300w,
                                                    <?= $coverImage->thumb(['width' => 600])->url() ?> 600w,
                                                    <?= $coverImage->thumb(['width' => 900])->url() ?> 900w,
                                                    <?= $coverImage->thumb(['width' => 1200])->url() ?> 1200w,
                                                    <?= $coverImage->thumb(['width' => 1500])->url() ?> 1500w
                                                    "
                                                    sizes="100vw"
                                                    width="<?= $coverImage->width() ?>"
                                                    height="<?= $coverImage->height() ?>"
                                                    <?= $itemIndex === 1 ? '' : 'loading="lazy"' ?>
                                                    fetchpriority="high"
                                                    alt="<?= $coverImage->alt()->or($workPost->title()) ?>"
                                                    class="w-full"  
                                                />
                                        <?php elseif ($coverType === 'video' && $workPost->work_coverVideo()->toFile()): ?>
                                            <?php $coverVideo = $workPost->work_coverVideo()->toFile(); ?>
                                            <video class="w-full" 
                                                   controls 
                                                   muted 
                                                   playsinline
                                                   preload="metadata">
                                                <source src="<?= $coverVideo->url() ?>" type="<?= $coverVideo->mime() ?>">
                                                Your browser does not support the video tag.
                                            </video>
                                        <?php elseif ($coverType === 'youtube' && $workPost->work_coverYoutube()->isNotEmpty()): ?>
                                            <?php 
                                            $youtubeUrl = $workPost->work_coverYoutube()->value();
                                            $youtubeEmbed = youtubePrivacy($youtubeUrl, ['modestbranding' => 1, 'rel' => 0], [
                                                'style' => 'position: absolute; top: 0; left: 0; width: 100%; height: 100%;',
                                                'loading' => 'lazy'
                                            ]);
                                            ?>
                                            <?php if ($youtubeEmbed): ?>
                                                <div class="video-wrapper" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                                                    <?= $youtubeEmbed ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                
                                <p class="px-16 xl:p-0 flex items-center gap-2">
                                    <?= $workPost->title() ?>
                                    <span class="xl:hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-right">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M9 6l6 6l-6 6" />
                                        </svg>
                                    </span>
                                </p>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
</main>
<?php snippet('footer'); ?>