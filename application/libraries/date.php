<?php

class DATE 
{
	function getTodaysDate()
	{
		return date('Y-m-d');
	}
	
	function getCurrentTime()
	{
		return date("H:i:s", time());
	}
	
	function getCurrentDateTime($date = '', $format='Y-m-d H:i:s')
	{
	   return (empty($date)  ? date($format) : date($format, strtotime($date)));	
	}
	
	function checkValidDate($date) 
	{
			  $d = explode('-', $date);
		return checkdate($d[1], $d[2], $d[0]);
	}
	
	function checkToSeeLeapYear($year) 
    { 
		return ((($year%4==0) && ($year%100)) || $year%400==0) ? (true):(false); 
	} 

	function getFormattedDate($date, $format='Y-m-d H:i:s')
	{
	   return date($format, strtotime($date));	
	}
	
	function getTimeLength($start,$end=false) 
	{
		$from   = new DateTime($start);
		$to     = $end?new DateTime($end):new DateTime($this->getTodaysDate());
		$result = $from->diff($to);
		 
		$timeLength = array('years'=>$result->y,'months'=>$result->m,'days'=>$result->d); //'%d Years(s), %d Month(s)',$result->y,$result->m);
	    return $timeLength;
	}
	
	function getTimeDiff($date) {
                    
                    // DEFINE DATES
		   $str   = strtotime($date);
		   $today = strtotime(date('Y-m-d H:i:s'));

        // GET TIME DIFF IN SECONDS
           $timeDiff = $today-$str;

		// DEFINE TIME STRING
		   $timeStr = array (
						'years'         =>  60*60*24*365,
						'months'        =>      60*60*24*30,
						'days'          =>      60*60*24,
						'hours'         =>      60*60,
						'minutes'       =>      60
		   );

		// CHECK TIME DIFFS
		   $yearDiff    = intval($timeDiff/$timeStr['years']);
		   $monthDiff   = intval($timeDiff/$timeStr['months']);
		   $dayDiff             = intval($timeDiff/$timeStr['days']);
		   $hourDiff    = intval($timeDiff/$timeStr['hours']);
		   $minuteDiff  = intval($timeDiff/$timeStr['minutes']);
		   $secondDiff  = intval(($timeDiff));

		// SET THE RESULTS
		   if ($yearDiff > 1)            return $yearDiff. " years ago";
		   else if ($yearDiff > 0)       return $yearDiff. " year ago";
		   else if ($monthDiff > 1)  return $monthDiff. " months ago";
		   else if ($monthDiff > 0)  return $monthDiff. " month ago";
		   else if ($dayDiff > 1)        return $dayDiff. " days ago";
		   else if ($dayDiff > 0)        return $dayDiff. " day ago";
		   else if ($hourDiff > 1)       return $hourDiff. " hours ago";
		   else if ($hourDiff > 0)       return $hourDiff. " hour ago";
		   else if ($minuteDiff > 1) return $minuteDiff. " minutes ago";
		   else if ($minuteDiff > 0) return $minuteDiff. " minute ago";
           else if ($secondDiff > 1) return $secondDiff. " seconds ago";
           else if ($secondDiff > 0) return "few seconds ago";
           else if ($secondDiff == 0) return "just now";
        }
	
}