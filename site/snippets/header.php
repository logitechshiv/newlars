<!DOCTYPE html>
<html lang="de">

<head>
  
<?php snippet('head'); ?>
    
<link rel="apple-touch-icon" sizes="180x180" href="<?= url('assets/favicon/apple-touch-icon.png') ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?= url('assets/favicon/favicon-32x32.png') ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?= url('assets/favicon/favicon-16x16.png') ?>">
<link rel="shortcut icon" href="<?= url('assets/favicon/favicon.ico') ?>">

<?= css('assets/css/style.css') ?>

</head>

<body>

    <a href="#main-content"
        class="fixed top-16 left-16 bg-black text-white z-[99999] py-10 px-25 border border-white not-focus:sr-only transition-all duration-300">
        Skip to Content
    </a>

    <?php if ($page->isHomePage()): ?>
    <!-- <div id="loader" class="fixed inset-0 bg-white grid place-items-center z-[9999]">
        <div class="text-black text-4xl xl:text-6xl font-bold counter">0%</div>
        <div
            class="absolute bottom-0 left-0 w-full h-0 bg-black reveal text-white text-[clamp(2.1875rem,1.6875rem+2.5vw,4.6875rem)] font-bold counter grid place-items-center uppercase tracking-widest">
            Lars Borges
        </div>
    </div> -->
    <?php endif; ?>

    <header class="p-16 xl:py-24 xl:px-32 sticky top-0 z-50 bg-white overflow-hidden">
        <div class="container">
            <div class="flex items-center justify-between">
                <a href="<?= $site->url() ?>" class="animated_link text-lg">
                    <?= $site->title() ?>
                </a>
                <button aria-label="Primary menu toggler"
                    class="relative z-[60] mix-blend-difference text-white primaryMenuToggler">
                    <svg class="menuIcon" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 8l16 0" />
                        <path d="M4 16l16 0" />
                    </svg>
                    <svg class="closeIcon absolute top-0 left-0 opacity-0" xmlns="http://www.w3.org/2000/svg" width="20"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6l-12 12" />
                        <path d="M6 6l12 12" />
                    </svg>
                    <span class="absolute -inset-20"></span>
                </button>
            </div>
        </div>

        <div class="fixed inset-0 bg-black text-white py-64 px-32 xl:pt-128 xl:pr-32 xl:pb-32 xl:pl-128 overflow-y-auto z-50"
            id="primaryMenu">
            <a href="<?= $site->url() ?>" class="text-h1 mb-8 xl:mb-16 fade_in">
                Lars <br> Borges
            </a>
            <nav>
                <ul class="text-xl xl:text-2xl mb-24 xl:mb-48 flex flex-col gap-6 xl:gap-12">
                    <?php if ($site->mainMenu()->isNotEmpty()): ?>
                    <?php foreach ($site->mainMenu()->toStructure() as $item): ?>
                        <li>
                            <?php 
                            // Check if the link is an anchor link (starts with #)
                            $linkUrl = $item->link()->toUrl();
                            $linkValue = $item->link()->value();
                            
                            ?>
                            <a aria-label="<?= $item->linkTitle() ?> link" class="animated_link fade_in" href="<?= $linkUrl ?>">
                                <?= $item->linkTitle() ?>
                            </a>
                        </li>
                    <?php endforeach ?>
                    <?php endif ?>
                </ul>
            </nav>
            <ul class="text-[15px] space-y-4">
                <li>
                    <a href="tel:<?= str_replace(' ', '', $site->phone()) ?>" class="animated_link fade_in"><?= $site->phone() ?></a>
                </li>
                <li>
                    <a class="animated_link fade_in"
                        href="mailto:<?= $site->email() ?>"><?= $site->email() ?></a>
                </li>
            </ul>
            <?php if ($site->instagram()->isNotEmpty()): ?>
                <div class="absolute right-32 bottom-32">
                    <a href="<?= $site->instagram()->toUrl() ?>" target="_blank"
                        class="text-xl xl:text-2xl animated_link fade_in">Instagram</a>
                </div>
            <?php endif; ?>
        </div>
    </header>