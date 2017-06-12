<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "guzmanga-db", "ipADQxOvDEPmKJfr", "guzmanga-db");
if($mysqli->connect_errno){
  echo "Connection error" . $mysqli->connect_errno . " " . $mysqli->connect_errno;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
   <head>
	 <meta charset="utf-8"/>
   </head>
   <body>
    <table>
      <tr>
          <td>Vehicle</td>
        </tr>
        <tr>
          <td>Name</td>
          <td>Class</td>
        </tr>
  <?php
  if(!($stmt = $mysqli->prepare("SELECT vehicles.v_name, vehicles.class FROM vehicles INNER JOIN pilots ON
                                 vehicles.id = pilots.vehicle_id INNER JOIN person ON person.id=pilots.p_id
                                 WHERE person.id = ?"))){
                                   echo "Prepare failed: " . $stmt->errno. " " . $stmt->error;
                                 }

  if(!($stmt->bind_param("i", $_GET['person']))){
    echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
  }

  if(!$stmt->execute()){
    echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
  }

  if(!$stmt->bind_result($name, $v_class)){
    echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_errno;
  }

  while($stmt->fetch()){
    echo "<tr>\n<td>\n" . $name . "\n</td><td>\n" . $v_class . "\n</td>\n<tr>";
  }
  $stmt->close();
  ?>
</table>
</div>
  <div class="button"><a href="starwarsmain.php"> Return</a></div>
</body>
</html>
