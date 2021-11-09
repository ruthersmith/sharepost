<?php require_once APP_ROUTE . '/views/includes/header.php'; ?>

<div class="containter">

	<div class="col-md-6 mx-auto mt-5" >

		<div class="card card-body bg-light ">
			<a class="text-decoration-none btn-light" href="<?php echo URL_ROUTE?>/posts" > 
				<i class="fa fa-backward"></i> Back
			</a>
			<h2>Edit Post</h2>
			<form action="<?php echo URL_ROUTE?>/posts/edit/<?=$data['post_id'] ?>" method='post' >
			
				<div class="form-group">
					<label>Title<sup>*</sup>: </label>
					<input type="text" name="title" class="form-control <?php echo(!empty($data['title_error'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['title'] ?>">
					<span class="invalid=feedback"> <?php echo $data['title_error'] ?> </span>
				</div>
			
				<div class="form-group mb-2">
					<label>Body<sup>*</sup>: </label>
					<textarea rows="10" name="body" class="form-control <?php echo(!empty($data['body_error'])) ? 'is-invalid' : '' ?>" ><?php echo $data['body'] ?>
					</textarea>
					<span class="invalid=feedback"> <?php echo $data['body_error'] ?> </span>
				</div>

				<input type="submit" class="btn btn-success" value="submit">
			</form>

		</div>
	</div>

</div>

<?php require_once APP_ROUTE . '/views/includes/footer.php'; ?>
