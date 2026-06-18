<?php

namespace App\Support;

use Illuminate\Support\Str;
use League\CommonMark\GithubFlavoredMarkdownConverter;

/**
 * Markdown renderer for Learnings.
 *
 * Code blocks and LaTeX math are protected from the Markdown parser (which
 * would otherwise mangle backslashes / underscores), then restored:
 *   - fenced/inline code  -> <pre><code class="language-…"> for highlight.js
 *   - $…$, $$…$$, \(…\), \[…\] -> left raw for KaTeX to render client-side
 */
class Markdown
{
    public static function toHtml(string $text): string
    {
        if (trim($text) === '') {
            return '';
        }

        $text = str_replace(["\r\n", "\r"], "\n", $text);
        $store = ['code' => [], 'inline' => [], 'math' => []];

        // 1) fenced code blocks ```lang ... ```
        $text = preg_replace_callback('/```[ \t]*([\w+#.-]*)[ \t]*\n(.*?)```/s', function ($m) use (&$store) {
            $i = count($store['code']);
            $store['code'][$i] = ['lang' => strtolower(trim($m[1])), 'code' => rtrim($m[2], "\n")];

            return "\n\nPANTHERACODE{$i}ENDTOKEN\n\n";
        }, $text);

        // 2) inline code `…`
        $text = preg_replace_callback('/`([^`\n]+)`/', function ($m) use (&$store) {
            $i = count($store['inline']);
            $store['inline'][$i] = $m[1];

            return "PANTHERAINLINE{$i}ENDTOKEN";
        }, $text);

        // 3) math — store the full match (delimiters included), restore verbatim
        $patterns = [
            '/\$\$(.+?)\$\$/s',                                  // $$ … $$
            '/\\\\\[(.+?)\\\\\]/s',                              // \[ … \]
            '/\\\\\((.+?)\\\\\)/s',                              // \( … \)
            '/(?<!\$)\$(?!\$)(?!\s)([^\n$]+?)(?<!\s)\$(?!\$)/',  // $ … $  (no surrounding spaces -> avoids prices)
        ];
        foreach ($patterns as $pat) {
            $text = preg_replace_callback($pat, function ($m) use (&$store) {
                $i = count($store['math']);
                $store['math'][$i] = $m[0];

                return "PANTHERAMATH{$i}ENDTOKEN";
            }, $text);
        }

        // 4) render the remaining prose
        $html = (string) (new GithubFlavoredMarkdownConverter([
            'html_input'         => 'escape',
            'allow_unsafe_links' => false,
        ]))->convert($text);

        // 5) restore math (raw -> KaTeX renders in the browser)
        foreach ($store['math'] as $i => $raw) {
            $t = "PANTHERAMATH{$i}ENDTOKEN";
            $html = str_replace(["<p>{$t}</p>", $t], [$raw, $raw], $html);
        }

        // 6) restore inline code
        foreach ($store['inline'] as $i => $code) {
            $html = str_replace("PANTHERAINLINE{$i}ENDTOKEN", '<code>' . e($code) . '</code>', $html);
        }

        // 7) restore fenced code (highlight.js targets language-* classes)
        foreach ($store['code'] as $i => $blk) {
            $t = "PANTHERACODE{$i}ENDTOKEN";
            $cls = $blk['lang'] !== '' ? ' class="language-' . e($blk['lang']) . '"' : '';
            $pre = '<pre><code' . $cls . '>' . e($blk['code']) . '</code></pre>';
            $html = str_replace(["<p>{$t}</p>", $t], [$pre, $pre], $html);
        }

        return $html;
    }

    /** Plain-text preview for excerpts / meta descriptions. */
    public static function preview(string $text, int $chars = 200): string
    {
        $text = preg_replace('/```.*?```/s', ' ', (string) $text);
        $text = preg_replace('/[#>*_`~$\[\]()!]+/', '', (string) $text);
        $text = trim(preg_replace('/\s+/', ' ', (string) $text));

        return Str::limit($text, $chars);
    }
}
