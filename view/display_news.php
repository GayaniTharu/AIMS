<!-- display_news.php -->

<?php
// Include necessary configurations and database connections here
// Fetch news details from your database based on the selected news ID
// Replace this with your actual database query
$newsTitle = "News Title"; // Replace with the actual title
$newsDescription = "News Description"; // Replace with the actual description
$imageURL = "image.jpg"; // Replace with the actual image URL
?>

<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="<?php echo $imageURL; ?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?php echo $newsTitle; ?></h5>
    <p class="card-text"><?php echo $newsDescription; ?></p>
  </div>
</div>
