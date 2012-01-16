<head>
<script>
	document.onload = test();
	
	function test(){
		var index = document.cookie.indexOf("gyvsession");
		//alert(document.cookie);
		//alert(index);
		if(index == -1)
			//alert("cookie not exist");
		else
			//alert("cookie exist exist");
	}
</script>
</head>
<?php
/*
 * Created on Sep 4, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 require_once ("../service/VenueService.php");
?>
<?php
$action = "";
if (array_key_exists('action', $_POST) && $_POST['action'] != null)
	$action = $_POST['action'];
else
	if (array_key_exists('action', $_GET) && $_GET['action'] != null)
		$action = $_GET['action'];
		
if ($action != "userAuthetication") {
        $venueService = new VenueService();
        if(!$venueService->isSessionExist()){
        	$message = "Session Expired";
        	require_once ("../view/cms/loginform.php");
        }
}

if ($action == "loadEditForm") {
        $venueService = new VenueService();
		$venueList = $venueService->getVenue();
       	require_once ("../view/cms/editVenue.php");
}
if ($action == "deleteVenue") { 
        $venueService = new VenueService();
		$databaseResponse = $venueService->deleteVenue();
		$message = "";
		if($databaseResponse==1){
			$message = "Successfully deleted";
		}
		else
			$message = "There is some problem in deletion of venue";
		$venueList = $venueService->searchVenue();
       	require_once ("../view/venue.php");
}
if ($action == "editVenue") {
        $venueService = new VenueService();
		$databaseResponse = $venueService->editVenue();
       	if($databaseResponse ==1 )
       		$message = "Successfully edited";
		else
			$message = "There is some problem in editing of venue";
			
		echo $message;
}

if ($action == "insertVenue") {
     $venueService = new VenueService();
     $databaseResponse = $venueService->insertVenue();
     
     if($databaseResponse!="fail")
			$message="Venue successfully added [venueId: ".$databaseResponse."]";
	else
		$message="There is some problem in insertion of venue";   
		
	require_once ("../view/InsertVenueForm.php");
}

if ($action == "userAuthetication") {
     
     $venueService = new VenueService();
     $status = $venueService->isValidUser();
     if(!$status){
     	$message = "Authentication Failed";
     	require_once ("../view/cms/loginform.php");
     }else{
     	$sessionId = $venueService->getSessionId();
     	$venueService->setCookie($sessionId);
     	$venueList = $venueService->searchVenueViaPostCall();
     	require_once ("../view/cms/venueList.php");
     }     	
}

if ($action == "logout") {
     $venueService = new VenueService();
     //$venueService->deleteCookie();
     if(isset($_COOKIE["gyvsession"]))
			setcookie("gyvsession", "", 1);
     
     $message = "Successfully Logout";
     require_once ("../view/loginform.php");
}
?>
