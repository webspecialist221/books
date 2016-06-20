<div class="menu">
  <ul>
    <li><a href="index.php" <?php if(page_name() == "index.php") echo "class='selected'"; ?>>Dashboard</a></li>
        <li><a href="books.php" <?php if(page_name() == "books.php" || page_name() == "book-add-edit.php" || page_name() == "book-process.php") echo "class='selected'"; ?>>Books</a></li>
  </ul>
</div>

</div>

<div class="submenu">
  <!-- Addig Categories submenu -->
  <?php if(page_name() == "index.php") { ?>
    <ul>
      <!-- <li><a href="categories.php">Categories</a></li>
      <li><a href="publishers.php">Publishers</a></li>
      <li><a href="authors.php">Authors</a></li> -->
      <li><a href="books.php">Books</a></li>
    </ul>
  <?php } ?>
  
  <?php if(page_name() == "books.php" || page_name() == "book-add-edit.php" || page_name() == "book-process.php") { ?>
    <ul>
      <li><a href="books.php" <?php if(page_name() == "books.php") echo "class='selected'"; ?>>List</a></li>
      <li><a href="book-add-edit.php?action=add" <?php if(page_name() == "book-add-edit.php") echo "class='selected'"; ?>>Add</a></li>
    </ul>
  <?php } ?>
</div>
