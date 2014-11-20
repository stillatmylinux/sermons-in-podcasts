INSERT INTO `sermons` 
SELECT ID FROM `wp_posts` p
JOIN `wp_term_relationships` r
	on p.ID = r.object_id
JOIN `wp_term_taxonomy` tt
	on r.term_taxonomy_id = tt.term_taxonomy_id
JOIN `wp_terms`t
	on t.term_id = tt.term_id
WHERE `post_type` = 'post' AND tt.taxonomy = 'category' AND t.slug = 'sermons'


UPDATE `wp_posts` SET `post_type` = 'sermon' WHERE ID IN (SELECT * FROM `sermons`)