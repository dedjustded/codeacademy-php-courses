<html>
<body>
<?php
$movies = array(
    array("title" => "american psycho", "director" => "mary horron", "year" => 2000, "rating" => 10),
    array("title" => "shrek", "director" => "a lot of people", "year" => 2001, "rating" => 10),
    array("title" => "kung fu panda", "director" => "mark and john", "year" => 2008, "rating" => 10)
);
foreach ($movies as $movie) {
    echo "Title: " . $movie["title"] . "<br>";
    echo "Director: " . $movie["director"] . "<br>";
    echo "Year: " . $movie["year"] . "<br>";
    echo "Rating: " . $movie["rating"] . "<br><br>";
}
?>
</body>
</html>