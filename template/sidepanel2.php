<!-- Sidebar -->
<div id="sidebar">
  <?php $categories = get_categories("LIMIT 10"); ?>
  <?php if(sizeof($categories) > 0) { ?>
    <div class="box">
      <div class="title">
        <h2>Categories</h2>
        <img class="bullet" src="css/images/bullet.png" alt="small grey bullet" />
      </div>
      <ul>
        <?php foreach($categories as $key => $category) { ?>
          <li><a href="ads_category.php?category_id=<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></a></li>
        <?php } ?>

      </ul>
    </div>
  <?php } ?>
  <?php $authors = get_authors("LIMIT 10"); ?>
  <?php if(sizeof($authors) > 0) { ?>
    <div class="box">
      <div class="title">
        <h2>Authors</h2>
        <img class="bullet" src="css/images/bullet.png" alt="small grey bullet" />
      </div>
      <ul>
        <?php foreach ($authors as $key => $author) { ?>
            <li><a href="ads_author.php?author_id=<?php echo $author['author_id']; ?>"><?php echo $author['author_name']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  <?php } ?>
  <div class="box">
    <div class="title">
      <h2>Follow Us</h2>
      <img class="bullet" src="css/images/bullet.png" alt="small grey bullet" />
    </div>
    <ul class="socials">
      <li><a title="Facebook" href="#"><img src="css/images/fb.png" alt="facebook icon" />facebook</a></li>
      <li><a title="Tweeter" href="#"><img src="css/images/tweet.png" alt="tweeter icon" />twitter</a></li>
     
    </ul>
  </div>
</div>
<!-- END Sidebar -->
