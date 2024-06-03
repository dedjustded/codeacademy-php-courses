<html>
<body>
    <?php
    function average() {
        $args = func_get_args();
        $count = func_num_args();
        if ($count == 0) {
          return 0;
        }
        $sum = 0;
        foreach ($args as $arg) {
          $sum += $arg;
        }
        return $sum / $count;
      }
      echo average (1,2,3,4,5);
    ?>

</body>
</html>