<?php
session_start();	
	
function openDB(){
    //$servername = "jasondpo.ipowermysql.com"; live host
	//$username = "jasoncode"; live host
	//$password = "codebank"; live host
	$username = "root";
	$password = "root";
	$dbname = "tvList";	

	// $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); live host
    $db = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
	if ($db != true){
    die("Unable to open DB ");
    }
    return($db);             
}

function createTables(){
    $db=openDB();
    		
	    $sql ="DROP TABLE IF EXISTS user";
	      $result = $db->query($sql);
            If ( $result != true){
            	die("Unable to drop user table");
            }
            else{
            	ECHO "<br>User table dropped";                
            }
	            
//////////////////////////////////// NEW TABLE ////////////////////////////////////  	            	     
	     
	    $sql="CREATE TABLE user ("
	    ."id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,"
	    ."pid VARCHAR(50) NOT NULL ,"
	    ."box VARCHAR(50) NOT NULL ,"
	    ."color VARCHAR(50) NOT NULL ,"
	    ."title VARCHAR(50) NOT NULL  );";
	   
	    
		$result=$db->query($sql);
	    if($result != true){
	        die("<br>Unable to create user table");
	   }
	   else{
	        ECHO "<br> User Table Created<br>";                
	     }
}
/////////////////////////// Start New Critique ///////////////////////////

/*
if (isset($_POST["addReview"])){
    $db = openDB();
        $sql ="INSERT INTO user (pid, box, color, title)" // 'color' would be replaced by tv show's unique id
                ." VALUES "
                ."( '2','boxReview','"
                .$_POST['myColors']."','"
                .$_POST['title']."' );"; 
        $result = $db->query($sql);
        if ( $result != true){
            //ECHO "<div class='alertBoxWrapper'><div class='alertBox'><h102>Unable to save information info</h102></div></div>";
         //  LogMsg("contacts.php insert contacts", $sql);
        }
        else{
            //ECHO "<div class='alertBoxWrapper'><div class='alertBox'><h102>information saved</h102></div></div>";
        }
      // initSession();  
}
*/


if (isset($_POST["addReview"])){
    $db = openDB();
        $sql ="INSERT INTO user (pid, box, color, title)" // 'color' would be replaced by tv show's unique id
                ." VALUES "
                ."( '0','boxOpen','".$_POST['myColors']."', ''),"
                ."( '1','boxReview','".$_POST['myColors']."','".$_POST['title']."'),"
                ."( '3','boxClose','".$_POST['myColors']."', '');";

                 
        $result = $db->query($sql);
        if ( $result != true){
            //ECHO "<div class='alertBoxWrapper'><div class='alertBox'><h102>Unable to save information info</h102></div></div>";
         //  LogMsg("contacts.php insert contacts", $sql);
        }
        else{
            //ECHO "<div class='alertBoxWrapper'><div class='alertBox'><h102>information saved</h102></div></div>";
        }
      // initSession();  
}



/////////////////////////// Add to TVList ///////////////////////////

if (isset($_POST["addToList"])){
    $db = openDB();
        $sql ="INSERT INTO user (pid, box, color, title)"
                  ." VALUES " 
                ."( '2','boxResponse','"
                .$_POST['myColors']."','"
                .$_POST['title']."' );"; 
        $result = $db->query($sql);
        if ( $result != true){
            //ECHO "<div class='alertBoxWrapper'><div class='alertBox'><h102>Unable to save information info</h102></div></div>";
         //  LogMsg("contacts.php insert contacts", $sql);
        }
        else{
            //ECHO "<div class='alertBoxWrapper'><div class='alertBox'><h102>information saved</h102></div></div>";
        }
      // initSession();  
}



/////////////////////////// Display TVList ///////////////////////////

function displayTVList(){
    
    $db = openDB();               
    $query = "SELECT id, color, title, box, pid FROM user ORDER BY color, pid, id";
    $ds = $db->query($query);
     $cnt = $ds->rowCount();
    if ($cnt == 0){
        echo "<span> No listings found </span>";
        return; // No contacts 
    } 
    // Fill scroll area             
    foreach ($ds as $row){
        //if($row["box"]=="boxResponse") {echo "<div class='".$row["color"]." box'>".$row["title"]."</div>";}
        if($row["box"]=="boxOpen") { echo "<div class='".$row["color"]." greyBar clearfix'>";}
        if($row["box"]=="boxReview" || $row["box"]=="boxResponse"){echo "<div data-id='".$row["id"]."' class='".$row["color"]." box'>".$row["title"]."<div class='deleteFdback-wrapper'><h10>Delete</h10></div></div>";}
        if($row["box"]=="boxClose") { echo "<div contentEditable='true' class='enterCommentBox'>Write a comment...</div></div>";}

    }
}
?>
