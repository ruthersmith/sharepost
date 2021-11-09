<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container">
    <a class="navbar-brand ml-3" href="<?php echo URL_ROOT ?> "> <?php echo SITE_NAME;?> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo URL_ROUTE ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URL_ROUTE .'/pages/about' ?>">About</a>
        </li>
      </ul>

      <?php if (isset($_SESSION['user'])): ?>

        <ul class="navbar-nav move-menu-item-right">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo URL_ROUTE ?>/users/logout">Logout</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Welcome, <?php echo $_SESSION['user']->name ?> </a>
          </li>
        </ul> 

      <?php else : ?>
        <ul class="navbar-nav move-menu-item-right" >
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo URL_ROUTE ?>/users/register">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URL_ROUTE .'/users/login' ?>">Login</a>
          </li>
        </ul> 
      <?php endif; ?>   
  </div>
  </div>
</nav>