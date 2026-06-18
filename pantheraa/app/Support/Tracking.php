<?php

namespace App\Support;

/**
 * Analytics / marketing tag markup, driven by the Tracking settings
 * (managed in the admin → Settings). Each snippet only renders when its ID
 * is present. Adapted from the reference CMS TrackingService.
 */
class Tracking
{
    protected static function get(string $key): ?string
    {
        $v = config("site.tracking.$key");

        return $v ? trim((string) $v) : null;
    }

    /** Markup injected into <head>. */
    public static function head(): string
    {
        $out = [];

        if ($v = static::get('gsc_verification')) {
            $out[] = '<meta name="google-site-verification" content="' . e($v) . '">';
        }
        if ($id = static::get('gtm_id')) {
            $id = e($id);
            $out[] = "<!-- Google Tag Manager --><script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{$id}');</script>";
        }
        if ($id = static::get('ga4_id')) {
            $id = e($id);
            $out[] = "<!-- GA4 --><script async src=\"https://www.googletagmanager.com/gtag/js?id={$id}\"></script><script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{$id}');</script>";
        }
        if ($id = static::get('meta_pixel_id')) {
            $id = e($id);
            $out[] = "<!-- Meta Pixel --><script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');fbq('init','{$id}');fbq('track','PageView');</script>";
        }
        if ($id = static::get('clarity_id')) {
            $id = e($id);
            $out[] = "<!-- Microsoft Clarity --><script>(function(c,l,a,r,i,t,y){c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};t=l.createElement(r);t.async=1;t.src=\"https://www.clarity.ms/tag/\"+i;y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y)})(window,document,\"clarity\",\"script\",\"{$id}\");</script>";
        }
        if ($id = static::get('hotjar_id')) {
            $id = e($id);
            $out[] = "<!-- Hotjar --><script>(function(h,o,t,j,a,r){h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};h._hjSettings={hjid:{$id},hjsv:6};a=o.getElementsByTagName('head')[0];r=o.createElement('script');r.async=1;r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;a.appendChild(r)})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');</script>";
        }

        return implode("\n", $out);
    }

    /** Markup injected right after <body> (GTM noscript). */
    public static function bodyOpen(): string
    {
        if ($id = static::get('gtm_id')) {
            $id = e($id);

            return "<noscript><iframe src=\"https://www.googletagmanager.com/ns.html?id={$id}\" height=\"0\" width=\"0\" style=\"display:none;visibility:hidden\"></iframe></noscript>";
        }

        return '';
    }
}
