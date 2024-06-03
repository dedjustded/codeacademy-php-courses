<?php
$xml = simplexml_load_file('example.xml');

echo '<table>';
echo '<thead><tr><th>Tag</th><th>Attributes</th><th>Value</th></tr></thead>';
echo '<tbody>';
foreach ($xml->children() as $child) {
    echo '<tr>';
    echo '<td>' . $child->getName() . '</td>';
    echo '<td>';
    foreach ($child->attributes() as $name => $value) {
        echo "$name=\"$value\" ";
    }
    echo '</td>';
    echo '<td>' . $child . '</td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';
?>
