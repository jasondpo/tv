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
	    ."pid VARCHAR(50) NOT NULL,"
	    ."tvphoto TEXT NOT NULL,"
	    ."box VARCHAR(50) NOT NULL,"
	    ."showid VARCHAR(50) NOT NULL,"
	    ."summary TEXT NOT NULL,"
	    ."review TEXT NOT NULL,"
	    ."title TEXT NOT NULL,"
	    ."feedback TEXT NOT NULL);"
	    ."INSERT INTO user (showid)"
	    ." VALUES"."( '9999');"; 
	   
	    
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
        $sql ="INSERT INTO user (pid, box, showid, title)" // 'showid' would be replaced by tv show's unique id
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

//////////////// This gets last/highest id. Create a session that stores this, then create column that increments per entry in order to place most recent to top. This replaces showid from api ////////
    $db = openDB();               
	$n = "SELECT id FROM user ORDER BY id DESC LIMIT 1";
	$ds = $db->query($n);
	foreach ($ds as $row){  
	$theID=$row["id"];	// 
 	//if($theID=="1"){$theID="999";}
 	//echo "<script>alert(".$theID.")</script>";
	};
	

	$dbi = openDB();               
	$ni = "SELECT showid FROM user WHERE id='".$theID."'ORDER BY showid ASC";  ////////////////////////////// this needs to grab the smallest showid
	$dsi = $dbi->query($ni);
	foreach ($dsi as $rowi){
 	if($rowi["showid"]=="99999"){
	 	$_SESSION["startID"]="9999";
	 	//echo "<script>alert(".$_SESSION["startID"].")</script>";
	}
 	else{
	 	$_SESSION["startID"]=$rowi["showid"]-1;
	 	//echo "<script>alert(".$_SESSION["startID"].")</script>";
 		}	
 	};


//////////
if (isset($_POST["addReview"])){
    $db = openDB();
        $sql ="INSERT INTO user (pid, box, tvphoto, showid, title, summary, review)" // 
                ." VALUES "
                ."( '0','boxOpen','','".$_SESSION["startID"]."', '', '', ''),"
                ."( '1','boxReview','".$_POST['tvflyer']."','".$_SESSION['startID']."','".$_POST['tvTitle']."','".mysql_real_escape_string($_POST['tvSummary'])."','".mysql_real_escape_string($_POST['userReview'])."'),"
//                 ."( '1','boxReview','".$_POST['tvImg']."','".$_SESSION['startID']."','".$_POST['tvTitle']."'),"
                ."( '3','boxClose','','".$_SESSION["startID"]."','', '', '');";

                 
        $result = $db->query($sql);
        if ( $result != true){
            //ECHO "<div class='alertBoxWrapper'><div class='alertBox'><h102>Unable to save information info</h102></div></div>";
         //  LogMsg("contacts.php insert contacts", $sql);
        }
        else{
            //ECHO "<div class='alertBoxWrapper'><div class='alertBox'><h102>information saved</h102></div></div>";
        }
}



/////////////////////////// Add to TVList ///////////////////////////

if (isset($_POST["addToList"])){
    $db = openDB();
        $sql ="INSERT INTO user (pid, box, showid, feedback)"
            ." VALUES " 
            ."( '2','boxResponse','"
            .$_POST['myColors']."','"
            .mysql_real_escape_string($_POST['title'])."' );"; // NOTE: mysql_real_escape_string is deprecated after php5.5.  Use mysqli_real_escape_string()

        $result = $db->query($sql);

        if ( $result != true){
            //ECHO "<div class='alertBoxWrapper'><div class='alertBox'><h102>Unable to save information info</h102></div></div>";
         //  LogMsg("contacts.php insert contacts", $sql);
        }
        else{
            //ECHO "<div class='alertBoxWrapper'><div class='alertBox'><h102>information saved</h102></div></div>";
        }
}


/////////////////////////// Display TVList ///////////////////////////

function displayTVList(){
    
    $db = openDB();               
    $query = "SELECT tvphoto, showid, title, box, pid, id, summary, feedback, review FROM user ORDER BY showid, pid, id";
    $ds = $db->query($query);
     $cnt = $ds->rowCount();
    if ($cnt == 0){
        echo "<span> No listings found </span>";
        return; // No contacts 
    }

    foreach ($ds as $row){
        if($row["box"]=="boxOpen") { echo "<div class='".$row["showid"]." greyBar clearfix'>";}
        if($row["box"]=="boxReview") { echo "<table class='tvTable'><tbody><tr><td colspan='2'><div class='boxUnderline'><div class='profile-reviewer'></div><h17><h18>Jason Dobbins  </h18>".$row["review"]."</h17><div data-id='".$row["showid"]."'class='deleteRev'></div></div></td></tr><td valign='top'><img src='".$row["tvphoto"]."'></td><td valign='top'><h14>".$row["title"]."</h14><h15>".$row["summary"]."</h15></td><tbody></table>";} 
        if($row["box"]=="boxReview" || $row["box"]=="boxResponse"){echo "<div class='".$row["showid"]." box'><h16>".$row["feedback"]."</h16><div class='deleteFdback-wrapper'><div class='delete' data-id='".$row["id"]."'></div></div></div>";}
        if($row["box"]=="boxClose") { echo "<div class='profile-addComment'></div><div contentEditable='true' class='enterCommentBox'>Write a comment...</div></div>";}

    }
}

/////////////////////////// Delete Feedback ///////////////////////////

if(isset($_POST["deletFdback"])){
		$db = openDB();
        $sql ="DELETE FROM `user` WHERE id = "."'".$_POST["feedback-id"]."'"; 
        $result = $db->query($sql);	     
}


/////////////////////////// Delete Review ///////////////////////////
if(isset($_POST["deleteReview"])){
// 	   echo "<script>alert('".$_POST["show-pid"]."')</script>";
		$db = openDB();
        $sql ="DELETE FROM `user` WHERE showid = "."'".$_POST["show-pid"]."'"; 
        $result = $db->query($sql);	     
}
?>
