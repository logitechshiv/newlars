<?php
/** @var \Kirby\Cms\Page $page */
/** @var \Kirby\Cms\Site $site */

// Determine if this is the home page
$isHome = $page->isHomePage();

// Get SEO values - use page values if available, otherwise fallback to site values
$seoDesc = $isHome 
    ? $site->seodesc()->or($site->description()) 
    : $page->seodesc()->or($site->seodesc())->or($site->description());
    
$seoAuthor = $isHome 
    ? $site->seoauthor() 
    : $page->seoauthor()->or($site->seoauthor());
    
$seoTags = $isHome 
    ? $site->seotags() 
    : $page->seotags()->or($site->seotags());

// Get sharing image - page first, then site, then fallback
$shareImage = $page->twitterimage()->toFile();
if (!$shareImage) {
    $shareImage = $site->twitterimage()->toFile();
}

$shareImageUrl = $shareImage ? $shareImage->url() : '';

// Get sharing description - page first, then site
$shareDesc = $page->fbtwdesc()->or($site->fbtwdesc())->or($seoDesc);

// Get page title
$pageTitle = $page->title();
$siteTitle = $site->title();
$fullTitle = $isHome 
    ? $siteTitle 
    : $pageTitle . ' - ' . $siteTitle;

// Get page URL
$pageUrl = $page->url();
$canonicalUrl = $page->url('absolute');
?>

<meta charset="UTF-8">
<meta name="theme-color" content="#000">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $fullTitle ?></title>

<?php if ($seoDesc->isNotEmpty()): ?>
<meta name="description" content="<?= $seoDesc->escape() ?>">
<?php endif; ?>

<?php if ($seoAuthor->isNotEmpty()): ?>
<meta name="author" content="<?= $seoAuthor->escape() ?>">
<?php endif; ?>

<?php 
$seoTagsValue = $seoTags->isNotEmpty() ? $seoTags->value() : '';
if ($seoTagsValue): 
    // Handle tags - split by comma, trim each tag, and join back
    $tagsArray = is_array($seoTagsValue) ? $seoTagsValue : explode(',', $seoTagsValue);
    $tagsArray = array_map('trim', $tagsArray);
    $tagsArray = array_filter($tagsArray); // Remove empty values
    $tagsString = implode(', ', $tagsArray);
?>
<meta name="keywords" content="<?= htmlspecialchars($tagsString, ENT_QUOTES, 'UTF-8') ?>">
<?php endif; ?>

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?= $canonicalUrl ?>">
<meta property="og:title" content="<?= $pageTitle->escape() ?>">
<?php if ($shareDesc->isNotEmpty()): ?>
<meta property="og:description" content="<?= $shareDesc->escape() ?>">
<?php endif; ?>
<?php if ($shareImageUrl): ?>
<meta property="og:image" content="<?= $shareImageUrl ?>">
<?php endif; ?>

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?= $canonicalUrl ?>">
<meta property="twitter:title" content="<?= $pageTitle->escape() ?>">
<?php if ($shareDesc->isNotEmpty()): ?>
<meta property="twitter:description" content="<?= $shareDesc->escape() ?>">
<?php endif; ?>
<?php if ($shareImageUrl): ?>
<meta property="twitter:image" content="<?= $shareImageUrl ?>">
<?php endif; ?>

<!-- Canonical URL -->
<link rel="canonical" href="<?= $canonicalUrl ?>">

