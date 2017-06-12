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
          <td>Association</td>
        </tr>
        <tr>
          <td>Name</td>
          <td>alliance</td>
        </tr>
  <?php
  if(!($stmt = $mysqli->prepare("SELECT person.p_name, person.c_affiliation FROM person INNER JOIN associations ON
                                 person.id = associations.p_id INNER JOIN alliances ON alliances.id=associations.alliance_id
                                 WHERE alliances.id = ?"))){
                                   echo "Prepare failed: " . $stmt->errno. " " . $stmt->error;
                                 }

  if(!($stmt->bind_param("i", $_GET['alliances']))){
    echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
  }

  if(!$stmt->execute()){
    echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
  }

  if(!$stmt->bind_result($name, $alliance)){
    echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_errno;
  }

  while($stmt->fetch()){
    echo "<tr>\n<td>\n" . $name . "\n</td><td>\n" . $alliance . "\n</td>\n<tr>";
  }
  $stmt->close();
  ?>
</table>
</div>
  <div class="button"><a href="starwarsmain.php"> Return</a></div>
</body>
</html>
