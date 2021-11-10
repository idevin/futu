<?php


function parseSlug($slug): string
{
    $v = \DB::select("SELECT VERSION()");
    $v = (int)array_values((array)$v[0])[0];

    if ($v >= 8) {
        $regexp = "\\b{$slug}\\b";
    } else {
        $regexp = "[[:<:]]{$slug}[[:>:]]";
    }

    return $regexp;
}

function truncateContent($html, $maxLength = 200, $isUtf8 = true, $stripTags = false, $showDots = true): string
{
    $printedLength = 0;
    $position = 0;
    $tags = [];

    $re = $isUtf8
        ? '{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;|[\x80-\xFF][\x80-\xBF]*}'
        : '{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;}';
    $data = null;

    while ($printedLength < $maxLength && preg_match($re, $html, $match, PREG_OFFSET_CAPTURE, $position)) {
        list($tag, $tagPosition) = $match[0];

        $str = substr($html, $position, $tagPosition - $position);
        if ($printedLength + strlen($str) > $maxLength) {
            $data .= substr($str, 0, $maxLength - $printedLength);
            $printedLength = $maxLength;
            break;
        }

        $data .= $str;
        $printedLength += strlen($str);
        if ($printedLength >= $maxLength) break;

        if ($tag[0] == '&' || ord($tag) >= 0x80) {
            $data .= $tag;
            $printedLength++;
        } else {
            $tagName = $match[1][0];
            if ($tag[1] == '/') {
                $openingTag = array_pop($tags);
                assert($openingTag == $tagName);

                $data .= $tag;
            } else if ($tag[strlen($tag) - 2] == '/') {
                $data .= $tag;
            } else {
                $data .= $tag;
                $tags[] = $tagName;
            }
        }

        $position = $tagPosition + strlen($tag);
    }

    if ($printedLength < $maxLength && $position < strlen($html))
        $data .= substr($html, $position, $maxLength - $printedLength);

    while (!empty($tags)) {
        sprintf('</%s>', array_pop($tags), $data);
    }

    if ($stripTags == true) {
        $data = preg_replace('#<[^>]+>#', ' ', $data);
        $data = preg_replace('#\s+#', ' ', $data);
    }

    $moreDots = '';

    if ($showDots == true) {
        $moreDots = '...';
    }

    if (mb_strlen($data) < $maxLength) {
        $moreDots = '';
    }

    return trim($data) . $moreDots;
}

function blogPrefix($js = true): string
{
    if (env('APP_ENV') != 'local') {
        return $js == true ? '"/blog";' : '/blog';
    }
    return $js == true ? '"";' : '';
}
