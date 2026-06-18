@props(['name' => 'spark'])

@php
$paths = [
    'search'  => '<circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>',
    'spark'   => '<path d="M12 3v4M12 17v4M3 12h4M17 12h4"/><path d="M12 8.5 13.2 11l2.8 1-2.8 1L12 15.5 10.8 13 8 12l2.8-1L12 8.5Z"/>',
    'mobile'  => '<rect x="6" y="2.5" width="12" height="19" rx="2.5"/><path d="M11 18.5h2"/>',
    'target'  => '<circle cx="12" cy="12" r="8.5"/><circle cx="12" cy="12" r="4.5"/><circle cx="12" cy="12" r="1"/>',
    'chat'    => '<path d="M4 5.5h16v10H9l-4 3.5V15.5H4z"/>',
    'code'    => '<path d="m8 8-4 4 4 4"/><path d="m16 8 4 4-4 4"/><path d="m13.5 6-3 12"/>',
    'arrow'   => '<path d="M5 12h14"/><path d="m13 6 6 6-6 6"/>',
    'check'   => '<path d="m4 12 5 5L20 6"/>',
    'mail'    => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
    'phone'   => '<path d="M5 4h3l2 5-2.5 1.5a11 11 0 0 0 5 5L16 13l5 2v3a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2Z"/>',
    'pin'     => '<path d="M12 21s7-6.2 7-11a7 7 0 1 0-14 0c0 4.8 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/>',
    'menu'    => '<path d="M4 7h16M4 12h16M4 17h16"/>',
    'close'   => '<path d="m6 6 12 12M18 6 6 18"/>',
    'gauge'   => '<path d="M5 18a8 8 0 1 1 14 0"/><path d="m12 14 4-4"/>',
    'bolt'    => '<path d="M13 3 4 14h7l-1 7 9-11h-7l1-7Z"/>',
    'shield'  => '<path d="M12 3 5 6v5c0 4.5 3 8 7 10 4-2 7-5.5 7-10V6l-7-3Z"/>',
    'bot'     => '<rect x="4" y="8" width="16" height="11" rx="3"/><path d="M12 8V4.5"/><circle cx="12" cy="3.5" r="1.2"/><path d="M9.5 13h.01M14.5 13h.01"/><path d="M9.5 16h5"/><path d="M2 12v3M22 12v3"/>',
    'workflow'=> '<rect x="3" y="3.5" width="6" height="5" rx="1.2"/><rect x="15" y="15.5" width="6" height="5" rx="1.2"/><path d="M9 6h4.5a3.5 3.5 0 0 1 3.5 3.5V15.5"/>',
    'wand'    => '<path d="m4 20 9-9"/><path d="M15 3.5l1 2.2 2.2 1-2.2 1-1 2.2-1-2.2-2.2-1 2.2-1 1-2.2Z"/><path d="M19.5 13.5l.01.01"/>',
    'plug'    => '<path d="M9 2.5v4M15 2.5v4"/><path d="M7 6.5h10v3.5a5 5 0 0 1-10 0V6.5Z"/><path d="M12 15v6"/>',
    'mic'     => '<rect x="9" y="3" width="6" height="11" rx="3"/><path d="M5.5 11a6.5 6.5 0 0 0 13 0"/><path d="M12 17.5V21"/>',
    'linkedin'=> '<rect x="3" y="3" width="18" height="18" rx="3"/><path d="M8 10v6M8 7v.01M12 16v-3.5a1.5 1.5 0 0 1 3 0V16M12 16v-6"/>',
    'instagram'=> '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><path d="M17 7v.01"/>',
    'x'       => '<path d="M4 4l16 16M20 4 4 20"/>',
    'youtube' => '<rect x="3" y="6" width="18" height="12" rx="3"/><path d="m10 9 5 3-5 3z"/>',
];
$d = $paths[$name] ?? $paths['spark'];
@endphp

<svg {{ $attributes->merge(['class' => 'h-6 w-6', 'fill' => 'none', 'stroke' => 'currentColor', 'stroke-width' => '1.6', 'stroke-linecap' => 'round', 'stroke-linejoin' => 'round']) }}
     viewBox="0 0 24 24" aria-hidden="true">
    {!! $d !!}
</svg>
