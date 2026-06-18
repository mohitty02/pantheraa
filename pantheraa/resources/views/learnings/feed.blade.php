<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>{{ $title }}</title>
        <link>{{ url('/learnings') }}</link>
        <atom:link href="{{ url('/learnings/feed') }}" rel="self" type="application/rss+xml" />
        <description>{{ $description }}</description>
        <language>en</language>
        <lastBuildDate>{{ $lastBuild }}</lastBuildDate>
        @foreach($items as $l)
            <item>
                <title>{{ $l->title }}</title>
                <link>{{ $l->url }}</link>
                <guid isPermaLink="true">{{ $l->url }}</guid>
                <pubDate>{{ optional($l->published_at)->toRssString() }}</pubDate>
                @if($l->category)<category>{{ $l->category }}</category>@endif
                <description><![CDATA[{{ $l->excerpt }}]]></description>
            </item>
        @endforeach
    </channel>
</rss>
