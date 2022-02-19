<?php get_header(); ?>
<?php $image =   $post->poster; ?>




<!-- 
update_post_meta($post_id, 'movie_title', $_POST['movie_title']);
	update_post_meta($post_id, 'runtime', $_POST['runtime']);
	update_post_meta($post_id, 'release_date', $_POST['release_date']);
	update_post_meta($post_id, 'poster', $_POST['poster']);
	update_post_meta($post_id, 'director', $_POST['director']);
	update_post_meta($post_id, 'runtime', $_POST['runtime']);
	update_post_meta($post_id, 'actors', $_POST['actors']); -->



<div id="primary" class="content-area">

    <h1><?php echo $post->movie_title; ?></h1>
    <img src="<?php echo $post->poster; ?>">


    <p> <strong>Runtime:</strong> <?php echo $post->runtime; ?></p>
    <p> <strong> Release date:</strong> <?php echo $post->release_date; ?></p>
    <p><strong> Director:</strong> <?php echo $post->director; ?></p>
    <p><strong>Actors:</strong> <?php echo $post->actors; ?></p>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>