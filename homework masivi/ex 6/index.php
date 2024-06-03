<html>
<body>
<?php
$knigas = array(
    array("title" => "The physics of sorrow", "author" => "georgi gospodinov", "year" => 2011, "genre" => "probably something with javascript"),
    array("title" => "Bai Ganyo", "author" => "Aleko Konstantinov", "year" => 1895, "genre" => "comedy"),
    array("title" => "Pod Igoto", "author" => "Ivan Vazov", "year" => 1893, "genre" => "Historical?"),
);
displayBooks($knigas);
function displayBooks($knigas) {
    echo "<table>";
    echo "<thead><tr><th>Title</th><th>Author</th><th>Year</th><th>Genre</th></tr></thead>";
    echo "<tbody>";
    foreach ($knigas as $knigi) {
        echo "<tr>";
        echo "<td>{$knigi['title']}</td>";
        echo "<td>{$knigi['author']}</td>";
        echo "<td>{$knigi['year']}</td>";
        echo "<td>{$knigi['genre']}</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}
?>
</body>
</html>