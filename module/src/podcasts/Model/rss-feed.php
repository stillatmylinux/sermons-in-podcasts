<?php

class sip_PodcastRSS {
	public $channel;
	public $items;

	public function __construct( $channel = null, $items = null ) {
		$this->channel = (isset( $channel )) ? $channel : new sip_PodcastChannel();
		//$this->items   = (isset( $items )) ? $items : null;
	}
}

/**
 * Podcast channel
 */
class sip_PodcastChannel {
	public $title;               // Name column
	public $link;                // Website link under podcast details
	public $copyright;           // Visible under podcast details
	public $itunes_author;       // Visible under podcast title and in iTunes Store Browse
	public $language;
	public $description;
	public $block;        		 // Prevent an episode or podcast from appearing
	public $category;     		 // Visible under podcast details and in iTunes Store Browse
	public $subcategory;
	public $image;        		 // Same location as album art
	public $explicit;     		 // Parental advisory graphic under podcast details or episode badge in Name column
	public $complete;     		 // Indicates podcast complete; no more episodes
	public $new_feed_url; 		 // Not visible, reports new feed URL to iTunes
	public $owner_name;   		 // Not visible, used for contact only
	public $owner_email;
	public $subtitle;     		 // Description column
	public $summary;      		 // When the "circled i" icon in the Description column is clicked
}

/**
 * Podcast item
 */
class sip_PodcastItem {
	public $title;             // Name column
	public $pubDate;           // Released column Wed, 31 Dec 2008 17:34:12 GMT
	public $author;            // Visible under podcast title and in iTunes Store Browse
	public $block;             // Prevent an episode or podcast from appearing
	public $image;             // Same location as album art
	public $duration;          // Time column 1:04:26
	public $explicit;          // Parental advisory graphic under podcast details or episode badge in Name column
	public $isClosedCaptioned; // Closed Caption graphic in Name column
	public $order;             // Override the order of episodes on the store
	public $subtitle;          // Description column
	public $summary;           // When the "circled i" icon in the Description column is clicked
	public $enclosure;		   // filename (URL)
	public $enclosure_alt;	   // filename (URL)
	public $length;			   // filesize in bytes
	public $keywords;          //funky, house, mix
}