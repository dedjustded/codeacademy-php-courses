<html>
    <body>
        <?php
        include "dates.helper.php"
        $date_in_past = '1970-01-01';
        function getcurrentDate(){
            $today=date('YYYY=mm-dd');
            return $today;
        }
        function calculatedateDifferenceDays($date1, $date2){
            $date_diff = date_diff_days($date1, $date2);
            return $date_diff;
        }
        echo calculateDateDifferenceDays($date_in_past, getCurrentDate());
;        ?>
        </h1>
    </body>
</html>