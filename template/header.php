<div id="top-navigation">
  <a class="" title="CART" href="post_ad.php">Add Post</a>
  <a class="cart" title="CART" href="cart.php">CART</a>
  <a class="checkout" title="CHECKOUT" href="checkout.php">CHECKOUT</a>
  <?php if(isset($_SESSION) && isset($_SESSION['role_id']) && isset($_SESSION['user_id'])) { ?>
    <?php if($_SESSION['role_id'] < 3) { ?>
      <a href="admin">Manage your store from Admin</a>
    <?php } elseif ($_SESSION['role_id'] == 3) { ?>
      <a href="user">Manage your Adds </a>
    <?php }  ?>
    <a class="logout" title="LOGOUT" href="login-process.php?action=logout">LOGOUT</a>
  <?php } else { ?>
    <a class="login" title="login" href="login-register.php">LOGIN / REGISTER</a>
  <?php } ?>
  <!-- <a title="My Account" href="#">MY ACCOUNT</a>
  <a class="logout" title="logout" href="index.php?action=logout">LOG OUT</a>
  <span>0 items</span><span class="sep">|</span><span>$0,00</span> -->
</div>
<div class="welcome-message">
  <?php if(isset($_SESSION) && isset($_SESSION['role_id']) && isset($_SESSION['user_id'])) { ?>
    <p>Welcome <strong><?php echo $_SESSION['full_name']; ?></strong> to <?php echo CLIENT_NAME; ?></p>
  <?php } else { ?>
    <p>Welcome Guest!</p>
  <?php } ?>
</div>
<div class="cl"></div>
<div id="wrapper-top"></div>
<!-- Wrapper Middle -->
<div id="wrapper-middle">
  <!-- Header -->
  <div id="header">
    <h1 id="logo"><a title="home" href="index.php"><?php echo CLIENT_NAME; ?></a></h1>
    <!-- Search -->
    <div id="search">
      <form action="search.php" method="post">
        <input type="text" name="search" class="field" value="Search entire book name here..." title="Search entire book name here..." />
        <input type="submit" value="" class="submit-button" />
      </form>
    </div>
    <!-- END Search -->
  </div>
  <!-- END Header -->
<?php require_once("navigation.php"); ?>
