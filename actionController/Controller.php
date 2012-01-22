<?php
require_once ("../service/VenueService.php");
//require_once ("../constants/Constants.php");
require_once ("../service/MailService.php");

if (array_key_exists('action', $_POST) && $_POST['action'] != null)
	$action = $_POST['action'];
else
	if (array_key_exists('action', $_GET) && $_GET['action'] != null)
		$action = $_GET['action'];

if ($action == "searchVenue") {
	
	$page=1;
	if(array_key_exists('page', $_GET) && $_GET['page']!=null) {
	 $page = $_GET['page'];
	}	
	$venueService = new VenueService();
	$venueList = $venueService->searchVenueForPagination($page);
	$regionName = $venueService->getRegion();
	$categoryName = $venueService->getCategory();
	$capacityValue = $venueService->getCapacity();
	
	$tmpVenueList=$venueService->searchVenue();
	$maxPages=ceil(count($tmpVenueList)/10);
	
	$fromPage="FILTER_SEARCH";
	require_once ("../view/searchresults.php");
}

if ($action == "viewChoices") {
	
	$page=1;
	if(array_key_exists('page', $_GET) && $_GET['page']!=null) {
	 $page = $_GET['page'];
	}
	if (array_key_exists('option', $_GET) && $_GET['option'] != null) {
		$choiceId = $_GET['option'];
		if ($choiceId == 1)
			$regionName = "Chattarpur Road";
		if ($choiceId == 2)
			$regionName = "Mundaka";
		if ($choiceId == 3)
			$regionName = "GT Karnal Road";
		if ($choiceId == 4)
			$regionName = "Pushpanjali and NH-8";
		if ($choiceId == 5)
			$regionName = "Vaishali Extn. and Vasundhara";
	} else {
		$regionName = "Others";
		$choiceId=0;
	}
	
	$venueService = new VenueService();
	$venueList = $venueService->getVenueByChoice();	
	$maxPages=ceil(count($venueList)/10);
	$venueList = $venueService->getVenueByChoiceForPagination($page);	
	$categoryName = "";
	$capacityValue = "";
	$fromPage=$choiceId;
	require_once ("../view/searchresults.php");
}

if($action == "bookNow") {

	$venueService = new VenueService();
	$response = $venueService->bookNow();
	//require_once ("../view/confirmation.php");
	$constants=new Constants();
	//header('Location:'.$constants->DOMAIN_URL.'confirmation');
	//header('Location:http://getyourvenue.com/confirmation');
	//require_once ("../view/VenueEditForm.php");
	require_once ("../view/confirmation.php");
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$contactNumber = $_POST['contact_no'];
	$location = $_POST['preferred_region'];
	$preferred_venue = $_POST['preferred_venue'];
	$date = $_POST['preferred_date'];
	$no_of_guests = $_POST['no_of_guests'];
	$budget = $_POST['budget'];
	$function = $_POST['type_of_function'];
	
	$mailStatus="";
	if($response==1){
		$mailService = new MailService();
		$mailStatus = $mailService->sendBookingNotificationMail($name,$contactNumber,$email,$location,$function,$budget,$date);
	}
}

if($action == "bookVenue") {

	$venueService = new VenueService();
	$response = $venueService->bookVenue();
	//require_once ("../view/confirmation.php");
	$constants=new Constants();
	//header('Location:'.$constants->DOMAIN_URL.'confirmation');
	//header('Location:http://getyourvenue.com/confirmation');
	require_once ("../view/confirmation.php");
	$name = $_POST['name'];
	$email = $_POST['email'];
	$contactNumber = $_POST['contactNumber'];
	$location = $_POST['venueId'];
	$date = $_POST['date'];
	$budget = $_POST['budget'];
	$function = $_POST['function'];
	
	$mailStatus="";
	if($response==1){
		$mailService = new MailService();
		$mailStatus = $mailService->sendBookingNotificationMail($name,$contactNumber,$email,$location,
								$function,$budget,$date);
	}
}

if ($action == "contactUs") {
       $venueService = new VenueService();
       $response=$venueService->contactUs();
       //require_once ("../view/confirmation.php");
       $constants=new Constants();
	   //header('Location:'.$constants->DOMAIN_URL.'confirmation');
		//	header('Location:http://getyourvenue.com/confirmation');
		require_once ("../view/confirmation.php");
}




?>