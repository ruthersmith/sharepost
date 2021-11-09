<?php require_once APP_ROUTE . '/views/includes/header.php'; ?>
<div class="containter">

	<div class="col-md-6 mx-auto mt-5" >

		<div class="card card-body bg-light ">
			<a class="text-decoration-none btn-light" href="<?php echo URL_ROUTE?>/posts" > 
				<i class="fa fa-backward"></i> Back
			</a>
			<h2> <?= $data['post']->title ?> </h2>

			<div class="bg-secondary text-white p-2 mb-1">
				Written by <?= $data['author']->name ?> on <?= $data['post']->created_at ?> 
			</div>
			<p><?= $data['post']->body ?></p>
		
			<?php if($data['post']->user_id == $_SESSION['user']->id) : ?>
				<a class="btn btn-dark mb-2" href="<?=URL_ROUTE?>/posts/edit/<?=$data['post']->id?>">Edit</a>
				<form class="d-grid gap-2" action="<?=URL_ROUTE?>/posts/delete/<?=$data['post']->id?>" method="post">
					<input type="submit" value="Delete" class="btn btn-block btn-danger">
				</form>
			<?php endif; ?>

		</div>
	</div>


</div>

<?php require_once APP_ROUTE . '/views/includes/footer.php'; ?>
