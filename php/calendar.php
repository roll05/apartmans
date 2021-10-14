<?php

function build_calendar($month, $year){
   echo "Hello World!";
   
   $id=$_GET['id'];
$mysqli = new mysqli('localhost', 'root', '', 'apartmans');
$stmt = $mysqli->prepare("select * from datumiRezrvacija where apartmanid = ? AND MONTH(datum) = ? AND YEAR(datum) = ?");
$stmt->bind_param('sss', $id, $month, $year);
$bookings = array(); 

if($stmt->execute()){
  $result = $stmt->get_result();
  if($result->num_rows>0){
      while($row = $result->fetch_assoc()){ 
      $bookings [] =  $bookings[] = $row['datum'];
}
      
      $stmt->close();
  }
  }


$daysOfWeek  = array('Ponedeljak','Utorak','Sreda','Cetvrtak','Petak','Subota','Nedelja');
$firstDayOfMonth = mktime(0,0,0,$month,1,$year);
$numberDays = date('t',$firstDayOfMonth);
$dateComponents = getdate($firstDayOfMonth);
$monthName = $dateComponents['month'];
$dayOfWeek = $dateComponents['wday'];

if($dayOfWeek == 0){
$dayOfWeek =6;
}else{
$dayOfWeek = $dayOfWeek-1;
}


$dateToday = date('Y-m-d');
$calendar = "<table class='table table-bordered'>";
$calendar .= "<center><h2>$monthName $year</h2>";
$calendar.= "<a class='btn btn-xs btn-primary' href='?id=".$id."&month=".date('m', mktime(0, 0, 0, $month-1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Prethodni mesec</a> ";

$calendar.= " <a class='btn btn-xs btn-primary' href='?id=".$id."&month=".date('m')."&year=".date('Y')."'>Trenutni Mesec</a> ";

$calendar.= "<a class='btn btn-xs btn-primary' href='?id=".$id."&month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."'>Sledeci mesec</a></center><br>";
$calendar .= "<tr>";

foreach($daysOfWeek as $days){
$calendar.="<th style='width:12%;' class='header'>$days</th>";
}

$calendar.="</tr><tr>";
if($dayOfWeek > 0){
  for($k = 0; $k < $dayOfWeek;$k++){
      
      $calendar.="<td></td>";
  }
}
$currentDay =1;
$month = str_pad($month,2,"0",STR_PAD_LEFT);

while($currentDay<=$numberDays){

if($dayOfWeek == 7){
  $dayOfWeek = 0;
  $calendar.="</tr><tr>";
}

$currentDayRel=str_pad($currentDay,2,"0",STR_PAD_LEFT);
$date = "$year-$month-$currentDayRel";

$dayname = strtolower(date('l', strtotime($date)));
$eventNum = 0;
$today = $date ==date("Y-m-d")?"today" : "";
if($date<date('Y-m-d')){
       $calendar.="<td><h4>$currentDay</h4><button class='btn btn-danger btn-xs'>N/A</button>";
   }
elseif(in_array($date, $bookings)){$calendar.="<td class='$today'><h4>$currentDay</h4><button class='btn btn-danger btn-xs'>Rezervisano</button>";}
else{
       $calendar.="<td class='$today'><p hidden>$year-$month-$currentDayRel</p><h4>$currentDay</h4><button class='btn btn-success btn-xs datum' onclick = 'dodajDatum(event.currentTarget.previousSibling.previousSibling.innerText )'>Rezervisi</button>";
   }
      

$calendar .= "</td>";

$currentDay ++;
$dayOfWeek ++;
}
if($dayOfWeek != 7){
$remainingDays = 7- $dayOfWeek;
for($i = 0;$i<$remainingDays;$i++){
  $calendar.="<td></td>";
}
}
$calendar.="</tr>";
$calendar.="</table>";
echo $calendar;

}


echo build_calendar();
?>