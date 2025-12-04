<?php

/**
 * Privacy-enhanced YouTube embed helper
 * Uses youtube-nocookie.com to reduce tracking and console errors
 */
if (!function_exists('youtubePrivacy')) {
    function youtubePrivacy(string $url, array $options = [], array $attr = []): string|null {
        // Ensure title attribute is set for accessibility
        if (!isset($attr['title'])) {
            $attr['title'] = 'YouTube video player';
        }
        
        // Use Kirby's youtube helper but replace domain with privacy-enhanced mode
        $embed = \Kirby\Toolkit\Html::youtube($url, $options, $attr);
        if ($embed) {
            // Replace youtube.com with youtube-nocookie.com for privacy (reduces tracking/console errors)
            $embed = str_replace('www.youtube.com/embed', 'www.youtube-nocookie.com/embed', $embed);
            
            // Ensure title attribute is present in the iframe (accessibility requirement)
            if (stripos($embed, 'title=') === false) {
                $embed = preg_replace('/<iframe/i', '<iframe title="' . htmlspecialchars($attr['title'], ENT_QUOTES) . '"', $embed, 1);
            }
        }
        return $embed;
    }
}


