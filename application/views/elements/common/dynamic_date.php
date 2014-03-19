<?php
// FUNCTION CHECK TOTAL DAYS
if (!function_exists('checkTotalDays')) {
        function checkTotalDays($year, $month, $day) {
                $month = (empty($month)) ? 1 : $month;
                $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                for($i=1; $i <= $days; $i++) 
                {
                     $selected = ($i == $day) ? "selected='selected'" : "";
                     echo "<option value='" .$i. "' " .$selected. ">" .$i. "</option>";
                }
        }
}

// CHECK TO SEE IF DATE VARIABLE EXISTS
$day   = (isset($_POST['selDay']))   ? $_POST['selDay'] 	  : (isset($selDay)   ? $selDay : '');
$month = (isset($_POST['selMonth'])) ? $_POST['selMonth']  : (isset($selMonth) ? $selMonth : '');
$year  = (isset($_POST['selYear']))  ? $_POST['selYear']   : (isset($selYear)  ? $selYear : '');

// DEFINE ARRAY OF MONTHS
$months = Array(
         ''  => 'Month:',
         '01' => 'January',
         '02' => 'February',
         '03' => 'March',
         '04' => 'April',
         '05' => 'May',
         '06' => 'June',
         '07' => 'July ',
         '08' => 'August',
         '09' => 'September',
         '10' => 'October',
         '11' => 'November',
         '12' => 'December',
     );

     echo "<select name='selYear' id='selYear' onchange='setDateDynamicallyFunction()' class='required'>";
     $curYear = date('Y');
     echo "<option value=''>Year:</option>";
     for($i=0; $i<120; $i++) 
     {						
             $selectedYear = (($curYear - $i) == $year) ? "selected='selected'" : "";
             echo "<option value='" .($curYear - $i). "' " .$selectedYear. " >" .($curYear - $i). "</option>";
     }
     echo "</select>";

     echo "<select name='selMonth' id='selMonth' onchange='setDateDynamicallyFunction()' class='required'>";
     foreach($months as $k => $v) 
     {					
             $selectedMonth = ($k == $month) ? "selected='selected'" : "";
             echo "<option value='" .$k. "' " .$selectedMonth. " >" .$v. "</option>";
     }
     echo "</select>";

     echo "<select name='selDay' id='selDay' class='required'>";
             echo "<option value='' selected='selected'>Day:</option>";
             echo checkTotalDays($year, $month, $day);
     echo "</select>";
						
?>





