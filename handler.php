<?php

include_once("conn.php");

if(isset($_POST["content_txt"]) && strlen($_POST["content_txt"])>0)	{ 									

	// $contentToSave = filter_var($_POST["content_txt"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 	// Format characters
	
	$contentToSave = $_POST["content_txt"];
	
	$insert_row = $mysqli->query("INSERT INTO postDB(content) VALUES ('".$contentToSave."')");
	if($insert_row)	{																					
		
		$my_id = $mysqli->insert_id;																	
		// Fix ordenlig funktion
		$newItem .= '<li id="item_'.$my_id.'">																
		<div class="del_wrapper"><a href="#" class="del_button" id="del-'.$my_id.'">
		<img src="images/icon_del.gif" border="0" />
		</a></div> ' .$contentToSave . ' </li>';
		
		echo $newItem;
		
		$mysqli->close();
		exit;
	} else {
		// Ellers, Fejl
		exit(header('DB fejl, kunne ikke INSERTe'));
	}

} elseif (isset($_POST["recordToDelete"]) && strlen($_POST["recordToDelete"])>0 && is_numeric($_POST["recordToDelete"]))	{
	$idToDelete = filter_var($_POST["recordToDelete"],FILTER_SANITIZE_NUMBER_INT); 
	$delete_row = $mysqli->query("DELETE FROM postDB WHERE id = ".$idToDelete);
	
	if(!$delete_row)	{    
		// delete query fejler, vis fejlbesked 
		exit(header('DB fejl, kunne ikke slettes'));
	}
	$mysqli->close();
	
	} else {
		// Output error
		exit(header('Anmodning fejlede'));
}
?>