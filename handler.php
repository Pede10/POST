<?php

include_once("conn.php");

if(isset($_POST["content_txt"]) && strlen($_POST["content_txt"])>0) 
{	// Tjek $_POST

	// Format special characters
	$contentToSave = filter_var($_POST["content_txt"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
	
	// Insert string
	$insert_row = $mysqli->query("INSERT INTO
									postDB(content)
								VALUES
									('".$contentToSave."')");
	if($insert_row)
	{
		 // Success, display result 
		  $my_id = $mysqli->insert_id; // Fetcher nyeste ID
		  
$results = $mysqli->query("SELECT timestamp FROM postDB");
						   
							

while($row["id"] = $my_id->fetch_assoc())	{
	
	$tsHolder = '$row["timestamp"]';
	
	
			echo $tsHolder;
		  
		
		}
		
		  echo '<li id="item_'.$my_id.'">';
		  
		  echo '<div class="del_wrapper"><a href="#" class="del_button" id="del-'.$my_id.'">';
		  echo '<img src="images/icon_del.gif" border="0" />';
		  echo '</a></div>';
		  
		  echo $contentToSave;'</li>';
		  $mysqli->close();
	} else {
		// Ellers, Fejl
		header('HTTP/1.1 500 Looks like mysql error, could not insert record!');
		exit();
	}

}
elseif (isset($_POST["recordToDelete"]) && strlen($_POST["recordToDelete"])>0 && is_numeric($_POST["recordToDelete"]))
{	// Slet

	$idToDelete = filter_var($_POST["recordToDelete"],FILTER_SANITIZE_NUMBER_INT); 
	
	$delete_row = $mysqli->query("DELETE FROM
									postDB
								WHERE
									id = ".$idToDelete);
	
	if(!$delete_row)
	{    
		// delete query fejler, vis fejlbesked 
		header('HTTP/1.1 500 Could not delete record!');
		exit();
	}
	$mysqli->close(); 
}
else
{
	// Output error
	header('HTTP/1.1 500 Error occurred, Could not process request!');
    exit();
}
?>