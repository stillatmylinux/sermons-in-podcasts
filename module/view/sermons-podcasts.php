<?php

$items_xml = '';

foreach ( $items as $item ) {
	$items_xml .= <<< MMM
<item>
<title><![CDATA[{$item->title}]]></title>
<itunes:author><![CDATA[{$item->author}]]></itunes:author>
<itunes:subtitle><![CDATA[{$item->subtitle}]]></itunes:subtitle>
<itunes:summary><![CDATA[{$item->summary}]]></itunes:summary>
<enclosure url="{$item->enclosure}" length="92790784" type="audio/mpeg"/>
<guid>{$item->enclosure}</guid>
<pubDate>{$item->pubDate}</pubDate>
<itunes:duration>{$item->duration}</itunes:duration>
<itunes:keywords>{$item->keywords}</itunes:keywords>
<itunes:explicit>{$item->explicit}</itunes:explicit>
</item>
MMM;

}

$rss = <<< RSS
<?xml version="1.0" encoding="UTF-8"?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<title>{$title}</title>
<link>{$link}</link>
<language>{$language}</language>
<copyright>{$copyright}</copyright>
<itunes:subtitle>{$subtitle}</itunes:subtitle>
<itunes:author>{$author}</itunes:author>
<itunes:summary><![CDATA[{$summary}]]></itunes:summary>
<description><![CDATA[{$description}]]></description>
<itunes:owner>
<itunes:name>{$owner_name}</itunes:name>
<itunes:email>{$owner_email}</itunes:email>
</itunes:owner>
<itunes:image href="{$image}" />
<itunes:category text="{$category}">
<itunes:category text="{$subcategory}" />
</itunes:category>
<itunes:explicit>{$explicit}</itunes:explicit>
<atom:link href="http://www.faithb.org/podcasts/sermons/feed.xml" rel="self" type="application/rss+xml" />
{$items_xml}
</channel>
</rss>
RSS;

echo $rss;