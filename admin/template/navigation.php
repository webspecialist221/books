<div class="menu">
  <ul>
    <li><a href="index.php" <?php if(page_name() == "index.php") echo "class='selected'"; ?>>Dashboard</a></li>
    <li><a href="categories.php" <?php if(page_name() == "categories.php" || page_name() == "categories-add-edit.php" || page_name() == "categories-process.php") echo "class='selected'"; ?>>Categories</a></li>
    <li><a href="publishers.php" <?php if(page_name() == "publishers.php" || page_name() == "publisher-add-edit.php" || page_name() == "publisher-process.php") echo "class='selected'"; ?>>Publishers</a></li>
    <li><a href="authors.php" <?php if(page_name() == "authors.php" || page_name() == "author-add-edit.php" || page_name() == "author-process.php") echo "class='selected'"; ?>>Authors</a></li>
    <li><a href="books.php" <?php if(page_name() == "books.php" || page_name() == "book-add-edit.php" || page_name() == "book-process.php") echo "class='selected'"; ?>>Books</a></li>
    <li><a href="sales.php" <?php if(page_name() == "sales.php" || page_name() == "sale-add-edit.php" || page_name() == "sale-process.php") echo "class='selected'"; ?>>Sales</a></li>
    <?php if($_SESSION['role_id'] == 1) { ?>
      <li><a href="users.php" <?php if(page_name() == "users.php" || page_name() == "user-add-edit.php" || page_name() == "user-process.php") echo "class='selected'"; ?>>Users</a></li>
    <?php } ?>
  </ul>
</div>

</div>

<div class="submenu">
  <!-- Addig Categories submenu -->
  <?php if(page_name() == "index.php") { ?>
    <ul>
      <li><a href="categories.php">Categories</a></li>
      <li><a href="publishers.php">Publishers</a></li>
      <li><a href="authors.php">Authors</a></li>
      <li><a href="books.php">Books</a></li>
    </ul>
  <?php } ?>
  <?php if(page_name() == "categories.php" || page_name() == "categories-add-edit.php" || page_name() == "categories-process.php") { ?>
    <ul>
      <li><a href="categories.php" <?php if(page_name() == "categories.php") echo "class='selected'"; ?>>List</a></li>
      <li><a href="categories-add-edit.php?action=add" <?php if(page_name() == "categories-add-edit.php") echo "class='selected'"; ?>>Add</a></li>
    </ul>
  <?php } ?>
  <?php if(page_name() == "publishers.php" || page_name() == "publisher-add-edit.php" || page_name() == "publisher-process.php") { ?>
    <ul>
      <li><a href="publishers.php" <?php if(page_name() == "publishers.php") echo "class='selected'"; ?>>List</a></li>
      <li><a href="publisher-add-edit.php?action=add" <?php if(page_name() == "publisher-add-edit.php") echo "class='selected'"; ?>>Add</a></li>
    </ul>
  <?php } ?>
  <?php if(page_name() == "authors.php" || page_name() == "author-add-edit.php" || page_name() == "author-process.php") { ?>
    <ul>
      <li><a href="authors.php" <?php if(page_name() == "authors.php") echo "class='selected'"; ?>>List</a></li>
      <li><a href="author-add-edit.php?action=add" <?php if(page_name() == "author-add-edit.php") echo "class='selected'"; ?>>Add</a></li>
    </ul>
  <?php } ?>
  <?php if(page_name() == "books.php" || page_name() == "book-add-edit.php" || page_name() == "book-process.php") { ?>
    <ul>
      <li><a href="books.php" <?php if(page_name() == "books.php") echo "class='selected'"; ?>>List</a></li>
      <li><a href="book-add-edit.php?action=add" <?php if(page_name() == "book-add-edit.php") echo "class='selected'"; ?>>Add</a></li>
    </ul>
  <?php } ?>
  <?php if(page_name() == "sales.php" || page_name() == "sale-add-edit.php" || page_name() == "sale-process.php" || page_name() == "sale-view.php") { ?>
    <ul>
      <li><a href="sales.php" <?php if(page_name() == "sales.php" && !isset($_GET['status_id'])) echo "class='selected'"; ?>>List</a></li>
      <li><a href="sales.php?status_id=1" <?php if(isset($_GET['status_id']) && $_GET['status_id'] == 1) echo "class='selected'"; ?>>Orders</a></li>
      <li><a href="sales.php?status_id=2" <?php if(isset($_GET['status_id']) && $_GET['status_id'] == 2) echo "class='selected'"; ?>>In Process</a></li>
      <li><a href="sales.php?status_id=3" <?php if(isset($_GET['status_id']) && $_GET['status_id'] == 3) echo "class='selected'"; ?>>Process Complete</a></li>
    </ul>
  <?php } ?>
  <?php if($_SESSION['role_id'] == 1) { ?>
    <?php if(page_name() == "users.php" || page_name() == "user-add-edit.php" || page_name() == "user-process.php") { ?>
      <ul>
        <li><a href="users.php" <?php if(page_name() == "users.php") echo "class='selected'"; ?>>List</a></li>
        <li><a href="user-add-edit.php?action=add" <?php if(page_name() == "user-add-edit.php") echo "class='selected'"; ?>>Add</a></li>
      </ul>
    <?php } ?>
  <?php } ?>
</div>
