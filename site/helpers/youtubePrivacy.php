<?php

/**
 * Privacy-enhanced YouTube embed helper
 * Uses youtube-nocookie.com to reduce tracking and console errors
 */
if (!function_exists('youtubePrivacy')) {
    function youtubePrivacy(string $url, array $options = [], array $attr = []): string|null {
        // Use Kirby's youtube helper but replace domain with privacy-enhanced mode
        $embed = \Kirby\Toolkit\Html::youtube($url, $options, $attr);
        if ($embed) {
            // Replace youtube.com with youtube-nocookie.com for privacy (reduces tracking/console errors)
            $embed = str_replace('www.youtube.com/embed', 'www.youtube-nocookie.com/embed', $embed);
        }
        return $embed;
    }
}

