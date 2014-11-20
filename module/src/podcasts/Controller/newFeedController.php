<?php

class sip_NewFeedController {

	public function newFeed() {

		$feed = new sip_PodcastRSS();

		// @TODO get this values from the database
		$feed->channel->title = 'Faith Bible Church | Cedar Rapids, Iowa';
		$feed->channel->link = 'http://www.faithb.org/podcasts/sermons/feed.xml';
		$feed->channel->copyright = 'Faith Bible Church ' . date('Y');
		$feed->channel->author = 'Pastor Steve Benton, Pastor Bryan Regier, etc.';
		$feed->channel->block = false; // Prevent an episode or podcast from appearing
		$feed->channel->category = 'Religion &amp; Spirituality';
		$feed->channel->subcategory = 'Christianity';
		$feed->channel->image = 'http://www.faithb.org/podcasts/sermons/podcast_sermon_logo.png';
		$feed->channel->explicit = 'clean';
		$feed->channel->complete = false;
		$feed->channel->new_feed_url = false;
		$feed->channel->owner_name = 'Faith Bible Church'; // (name)
		$feed->channel->owner_email = 'podcasts@faithb.org'; // (email)
		$feed->channel->subtitle = 'Sermons from Faith Bible Church of Cedar Rapids, IA';
		$feed->channel->summary = 'Sermons from Faith Bible Church of Cedar Rapids, IA';
		$feed->channel->language	= 'en-us';
		$feed->channel->description = 'Welcome to the weekly sermon podcast for Faith Bible Church in Cedar Rapids, IA. Our mission is to make disciples and equip them to become fully devoted follwers of Jesus Christ.';
		$feed->items = $this->querySermons();

		return $feed;
	}

	public function querySermons() {

		$sermons = array();

		$custom_args = array(
			'post_type' => 'sermon',
			'posts_per_page' => -1,
			'meta_query' => array(
					array(
						'key'     => '_sip_enclosure',
						'value'   => '',
						'compare' => '!=',
					),
				)
		);

		$custom_query = new WP_Query( $custom_args );

		date_default_timezone_set ( 'America/Chicago' );

		if( $custom_query->have_posts() ):
			while( $custom_query->have_posts() ): $custom_query->the_post();
				
				$meta = get_post_meta( get_the_ID() );

				$sermon = new sip_PodcastItem();
				$sermon->title = str_replace('&#8217;', '\'', get_the_title() );

				// Wed, 02 Oct 2002 08:00:00 EST
				$sermon->pubDate = date ( 'D, d M Y H:i:s T', $meta['_sip_pubDate'][0] );
				$sermon->author = $meta['_sip_author'][0];
				$sermon->duration = $meta['_sip_duration'][0];
				$sermon->enclosure = $meta['_sip_enclosure'][0];
				$sermon->enclosure_alt = $meta['_sip_enclosure_video'][0];
				$sermon->isClosedCaptioned = $meta['_sip_isClosedCaptioned'][0];
				$sermon->order = $meta['_sip_order'][0];
				$sermon->subtitle = $meta['_sip_subtitle'][0];
				$sermon->summary = $meta['_sip_summary'][0];
				$sermon->explicit = (empty($meta['_sip_explicit'][0])) ? 'clean' : 'yes';
				$sermon->summary = $meta['_sip_summary'][0];
				$sermon->keywords = $meta['_sip_keywords'][0];

				array_push($sermons, $sermon);
			endwhile;

			return $sermons;
		endif;
	}

	public function feedItems() {
		$title = '';             // Name column
		$pubDate = '';           // Released column Wed, 31 Dec 2008 17:34:12 GMT
		$author = '';            // Visible under podcast title and in iTunes Store Browse
		$block = '';             // Prevent an episode or podcast from appearing
		$image = '';             // Same location as album art
		$duration = '';          // Time column 1:04:26
		$explicit = '';          // Parental advisory graphic under podcast details or episode badge in Name column
		$isClosedCaptioned = ''; // Closed Caption graphic in Name column
		$order = '';             // Override the order of episodes on the store
		$subtitle = '';          // Description column
		$summary = '';           // When the "circled i” icon in the Description column is clicked
		$enclosure = '';		 // filename (URL)
		$length = '';			 // 
		$keywords = '';          // funky, house, mix
	}

	public function writeFeedFile( $feed ) {

		$filename = ABSPATH . 'podcasts/sermons/feed.xml';

		$rss = array(
				'title'=>$feed->channel->title,
				'link'=>$feed->channel->link,
				'language'=>$feed->channel->language,
				'copyright'=>$feed->channel->copyright,
				'subtitle'=>$feed->channel->subtitle,
				'author'=>$feed->channel->author,
				'summary'=>$feed->channel->summary,
				'description'=>$feed->channel->description,
				'owner_name'=>$feed->channel->owner_name,
				'owner_email'=>$feed->channel->owner_email,
				'image'=>$feed->channel->image,
				'category'=>$feed->channel->category,
				'subcategory'=>$feed->channel->subcategory,
				'explicit'=>$feed->channel->explicit,
				'items'=>$feed->items,
			);

		extract( $rss );

		ob_start();
		include sip_PLUGIN_DIR . '/module/view/sermons-podcasts.php';
		$str = ob_get_contents();
		ob_end_clean();

		file_put_contents($filename, $str);
	}
}