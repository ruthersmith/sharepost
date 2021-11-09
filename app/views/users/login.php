<?php require_once APP_ROUTE . '/views/includes/header.php'; ?>

<div class="containter">
	<div class="row">
		<div class="col-md-6 mx-auto mt-5" >
			<div class="card card-body bg-light ">
				<?php flash('register_success'); ?>

				<h2>Login</h2>
				<p>Please fill out your credentials to login</p>
				<form action="<?php echo URL_ROUTE?>/users/login" method='post' >

				
					<div class="form-group">
						<label>Email<sup>*</sup>: </label>
						<input type="email" name="email" class="form-control <?php echo(!empty($data['email_error'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['email'] ?>">
						<span class="invalid=feedback"> <?php echo $data['email_error'] ?> </span>
					</div>
				
					<div class="form-group">
						<label>Password<sup>*</sup>: </label>
						<input type="password" name="password" class="form-control <?php echo(!empty($data['password_error'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['password'] ?>">
						<span class="invalid=feedback"> <?php echo $data['password_error'] ?> </span>
					</div>
			
				
					<div class="row mt-2">

						<div class="col-md-6">
							<input type="submit" name="submit" value="Login" class="btn btn-success col-12">
						</div>

						<div class="col-md-6">
							<a href="<?php echo URL_ROUTE?>/users/register" class="btn btn-light col-12">No  account ?</a>
						</div>

					</div>
					
				</form>

			</div>
		</div>
	</div>
</div>

<?php require_once APP_ROUTE . '/views/includes/footer.php'; ?>
