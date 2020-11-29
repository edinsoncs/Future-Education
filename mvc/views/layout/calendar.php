<?php
// Set your timezone!!
date_default_timezone_set('Asia/Dhaka');

// Get prev & next month
if (isset($_GET['ym'])) {
	$ym = $_GET['ym'];
} else {
	// This month
	$ym = date('Y-m');
}
// Check format
$timestamp = strtotime($ym,"-01");
if ($timestamp === false) {
	$timestamp = time();
}
// Today
$today = date('Y-m-j', time());
// For H3 title
$html_title = date('M - Y',$timestamp);
// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
// Number of days in the month
$day_count = date('t', $timestamp);
// 0:Sun 1:Mon 2:Tue ...
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
// Create Calendar!!
$weeks = array();
$week = '';
// Add empty cell
$week .= str_repeat('<td></td>', $str);
for ( $day = 1; $day <= $day_count; $day++, $str++) {
	$date = $ym.'-'.$day;
	if ($today == $date) {
		$week .= '<td class="today">'.$day;
	} else {
		$week .= '<td>'.$day;
	}
	$week .= '</td>';
	// End of the week OR End of the month
	if ($str % 7 == 6 || $day == $day_count) {
		if($day == $day_count) {
			// Add empty cell
			$week .= str_repeat('<td></td>', 6 - ($str % 7));
		}
		$weeks[] = '<tr>'.$week.'</tr>';
		// Prepare for new week
		$week = '';

	}

}

?>
<style type="text/css">
/* table style FOR Calendar */
.table-style {display:inline-block  compact}
.table-style  .today {background: #2A3F54; color: #ffffff;}
.table-style  th:nth-of-type(7),td:nth-of-type(7) {color: blue;}
.table-style  th:nth-of-type(1),td:nth-of-type(1) {color: red;}
.table-style  tr:first-child th{background-color:#F6F6F6; text-align:center; font-size: 15px}
</style>



<p class="well" style="padding:10px; margin-bottom:2px;">
  <span class="glyphicon glyphicon-calendar"></span>&nbsp; Calendario
</p>
<div class="col-md-12 " style="padding:0px;">
  <br>
  <table class="table-style table table-bordered table-responsive">
    <tr>
      <th colspan="2"><a href="?ym=<?php echo $prev; ?>"><spam class="fa fa-angle-left"></spam></a></th>
      <th colspan="3"><?php echo $html_title; ?></th>
      <th colspan="2"><a href="?ym=<?php echo $next; ?>"><spam class="fa fa-angle-right"></spam></a></th>
    </tr>
    <tr>
      <th>S</th>
      <th>M</th>
      <th>T</th>
      <th>W</th>
      <th>T</th>
      <th>F</th>
      <th>S</th>
    </tr>
    <?php
    foreach ($weeks as $week) {
      echo $week;
    };
    ?>
  </table>
</div>
