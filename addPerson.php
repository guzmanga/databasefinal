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
   <?php
    if(!($stmt = $mysqli->prepare("INSERT INTO person(p_name, species, homeworld, occupation, c_affiliation)
                                VALUES(?,?,?,?,?)"))){
                                  echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
                                }
    if(!($stmt->bind_param("sssss", $_POST['name'],$_POST['species'], $_POST['homeworld'],
                           $_POST['occupation'], $_POST['affiliation']))){
                             echo "Bind failed: " . $stmt->errno. " " . $stmt->error;
                           }
    if(!$stmt->execute()){
      echo "Execute failed: " . $stmt->errno . " ". $stmt->error;
    }else{
      echo "You added " . $stmt->affected_rows . " row to the person table.";
    }
    ?>
    <div class="button"><a href="starwarsmain.php">Return To Main Page></a></div>
</html>
