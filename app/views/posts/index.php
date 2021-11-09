<?php require_once APP_ROUTE . '/views/includes/header.php'; ?>


<div class="container">
	<div class="row">

		<div class="col-md-6">
			<h1>Posts</h1>
		</div>

		<div class="col-md-6">
			<a class="btn btn-primary" href="<?php echo URL_ROUTE?>/posts/add">
			<i class="fa fa-pencil"></i>
			Add Post
			</a>
		</div>

		<?php flash('post-message'); ?>

		<?php foreach($data['posts'] as $post): ?>
			<a href="<?=URL_ROUTE?>/posts/show/<?=$post->post_id?>" class="card card-body mb-3 text-decoration-none text-dark">
				<h4 class="card-title"> <?php echo $post->title  ?>  </h4>
				<div class="bg-light p-2 mb-3">
					written by <?php echo $post->name; ?> on <?php echo $post->created_at ?>
				</div>
				<p class="card-text"> <?= $post->body ?> </p>
			</a>
		<?php endforeach; ?>

	</div>
</div>


<?php require_once APP_ROUTE . '/views/includes/footer.php'; ?>

