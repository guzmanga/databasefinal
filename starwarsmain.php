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
  <legend class="topLabel"> Starwars Database </legend>
  <br>
  <hr>

  <!--character search section-->
  <label>Find a character's origin</label>
    <br>
  <!--search for person's homeworld-->
  <!--populate drop down menu for persons-->
  <div>
      <form method="get" action="personSelect.php">
        <fieldset>
          <legend>Person Name:</legend>
          <select name="person">
              <?php
              if(!($stmt = $mysqli->prepare("SELECT id, person.p_name FROM person"))){
                echo "Prepare failed: " . $stmt.errno . " " . $stmt->error;
              }

              if(!$stmt->execute()){
              	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
              }
              if(!$stmt->bind_result($id, $name)){
              	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
              }
              while($stmt->fetch()){
              	echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
              }
              $stmt->close();
              ?>
          </select>
        </fieldset>
      <p><input type="submit" value = "find homeworld"/></p>
    </form>
  </div>
  <!--search for person's associations-->

  <label>Find which associations a character belongs to:</label>
    <br>
  <!--populate drop down menu with alliances-->
  <div>
  <form method="get" action="alliancesSelect.php">
    <fieldset>
      <legend>Association Name:</legend>
      <select name="alliances">
        <?php
         if(!($stmt = $mysqli->prepare("SELECT id, alliances.a_name FROM alliances"))){
           echo "Prepare failed: " . $stmt.errno . " " . $stmt->error;
         }
         if(!$stmt->execute()){
           echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
         }
         if(!$stmt->bind_result($id, $name)){
           echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
         }
         while($stmt->fetch()){
           echo '<option value= "  '. $id . ' "> ' . $name. '</option>\n';
         }
         $stmt->close();
         ?>
       </select>
     </fieldset>
     <p><input type="submit" value = "find associations"/></p>
   </form>
 </div>

 <!--search for a person's subordinates-->
 <label>Find a character's subordinates</label>
   <br>
 <!--search for person's subordinates-->
 <!--populate drop down menu for persons-->
 <div>
     <form method="get" action="servesSelect.php">
       <fieldset>
         <legend>Person Name:</legend>
         <select name="person">
             <?php
             if(!($stmt = $mysqli->prepare("SELECT id, person.p_name FROM person"))){
               echo "Prepare failed: " . $stmt.errno . " " . $stmt->error;
             }

             if(!$stmt->execute()){
               echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
             }
             if(!$stmt->bind_result($id, $name)){
               echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
             }
             while($stmt->fetch()){
               echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
             }
             $stmt->close();
             ?>
         </select>
       </fieldset>
     <p><input type="submit" value = "find servants"/></p>
   </form>
 </div>

 <!--search for a person's vehicles-->
 <label>Find a character's vehicles</label>
   <br>
 <!--search for person's vehicles-->
 <!--populate drop down menu for vehicles-->
 <div>
     <form method="get" action="vehiclesSelect.php">
       <fieldset>
         <legend>Person Name:</legend>
         <select name="person">
             <?php
             if(!($stmt = $mysqli->prepare("SELECT id, person.p_name FROM person"))){
               echo "Prepare failed: " . $stmt.errno . " " . $stmt->error;
             }

             if(!$stmt->execute()){
               echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
             }
             if(!$stmt->bind_result($id, $name)){
               echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
             }
             while($stmt->fetch()){
               echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
             }
             $stmt->close();
             ?>
         </select>
       </fieldset>
     <p><input type="submit" value = "find vehicles"/></p>
   </form>

 </div>
 <!--adding entries-->
   <!--add person-->

   <label>Add a character to the database!</label>
  <br>
  <br>
  <div>
    <form method = "post" action="addPerson.php">
     <legend>Input new person: </legend>
     <fieldset>
     <p>Person Name: <input type="text" name="name"/></p>
     <p>Person Species: <input type="text" name="species"/></p>
     <p>Person Homeworld: <input type="text" name="homeworld"/</p>
     <p>Person Occupation: <input type="text" name="occupation"/</p>
     <p>Person Affiliation: <input type="text" name="affiliation"/</p>
      </fieldset>
     <p><input type="submit"/></p>
   </form>
 </div>




  <!--add world-->
  <label>Add a world to the database!</label>
  <br>
  <br>
  <div>
    <form method = "post" action="addWorld.php">
    <fieldset>
     <legend>Input new world: </legend>
     <p>World Name: <input type="text" name="name"/></p>
     <p>World Affiliation: <input type="text" name="affiliation"/></p>
     </fieldset>
     <p><input type="submit"/></p>
   </form>
   </div>

   <!--add alliance-->
   <label>Add an alliance to the database!</label>
   <br>
   <br>
   <div>
     <form method = "post" action="addAlliances.php">
     <fieldset>
      <legend>Input new alliance: </legend>
      <p>Alliance Name: <input type="text" name="name"/></p>
      </fieldset>
      <p><input type="submit"/></p>
    </form>
    </div>

    <!--add vehicles-->
    <label>Add a vehicle to the database!</label>
    <br>
    <br>
    <div>
      <form method = "post" action="addVehicles.php">
      <fieldset>
       <legend>Input new vehicle: </legend>
       <p>Vehicle Name: <input type="text" name="name"/></p>
       <p>Vehicle Class: <input type="text" name="class"/></p>
       </fieldset>
       <p><input type="submit"/></p>
     </form>
     </div>

</body>
</html>
