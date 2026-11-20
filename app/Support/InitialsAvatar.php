<?php

namespace App\Support;

/**
 * Initials avatar rendered locally as an SVG data URI.
 *
 * Replaces eu.ui-avatars.com, which received the names of players and
 * users with every page view. Look: grey background, dark initials.
 */
class InitialsAvatar
{
    public static function url(?string $name): string
    {
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64">'
            .'<rect width="64" height="64" fill="#dddddd"/>'
            .'<text x="50%" y="50%" dy=".1em" fill="#333333" font-family="Helvetica, Arial, sans-serif" '
            .'font-size="26" text-anchor="middle" dominant-baseline="middle">'
            .htmlspecialchars(static::initials($name), ENT_XML1 | ENT_QUOTES, 'UTF-8')
            .'</text></svg>';

        return 'data:image/svg+xml;base64,'.base64_encode($svg);
    }

    public static function initials(?string $name): string
    {
        $words = preg_split('/\s+/u', trim((string) $name), -1, PREG_SPLIT_NO_EMPTY);

        if (! $words) {
            return '?';
        }

        $initials = mb_substr($words[0], 0, 1);

        if (count($words) > 1) {
            $initials .= mb_substr(end($words), 0, 1);
        }

        return mb_strtoupper($initials);
    }
}
