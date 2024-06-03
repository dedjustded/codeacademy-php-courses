<?php
$text = '<p class="intro">This is an example paragraph.</p>
<a href="https://www.example.com">Link</a><img src="example.jpg" alt="Example Image">';
$regex = '/<(\w+)\s*[^>]*?(?:(?:\s+(\w+)=([\'"]).*?\3))*[^>]*?>/g';
preg_match_all($regex, $text, $matches, PREG_SET_ORDER);
foreach ($matches as $match) {
    $tag = $match[1];
    echo "HTML tag: $tag\n";
    if (count($match) > 2) {
        for ($i = 2; $i < count($match); $i += 3) {
            $attribute = $match[$i];
            $value = $match[$i+1];
            echo "  $attribute=\"$value\"\n";
        }
    }
}
?>


