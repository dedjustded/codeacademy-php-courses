<html>
    <body>
        <h1><?php
        $a = 5;
        $b = 3;
        {
            $c = $a;
            $a = $b;
            $b = $c;
        }
        echo "[$a, $b] $c"; 
        ?>
        </h1>
    </body>
</html>