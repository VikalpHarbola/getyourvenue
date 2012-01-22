<?php
require_once ("../util/DBUtils.php");
require_once ("../constants/DBConstants.php");
require_once ("../constants/SEOConstants.php");
require_once ("../exception/DBSourceException.php");
require_once ("../model/Venue.php");
require_once ("../model/VenueType.php");
require_once ("../model/Capacity.php");
require_once ("../model/PopularChoice.php");

class GetYourVenueMySQLManager {

	function getVenues($regionId, $categoryId, $capacityId) {

		$dbConstants = new DBConstants();
		$dBUtils = new DBUtils();
		$connection = $dBUtils->getDBConnection();
		$venueList = array ();
		//$offset = $dbConstants->pageOffset;TODO
		$dataBaseResponse = "";

		if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
			throw new DBSourceException("Unable to connect to a datasource.");
		} else {
			
			$query = $this->getSearchQuery($regionId,$categoryId,$capacityId);
			//echo $query;
			$result = mysql_query($query);

			while ($row = mysql_fetch_array($result)) {

				$venue = new Venue();
				$venue->id = $row['id'];
				$venue->venueId = $row['venueid'];
				$venue->venueName = $row['name'];
				$venue->venueAddr1 = $row['address1'];
				$venue->venueAddr2 = $row['address2'];
				$venue->content = $row['content'];
				$venue->mapUrl = $row['iframe'];
				$venue->altTag = $row['alttag'];
				
				$venueList[] = $venue;
			}
		}

		mysql_close($connection);
		return $venueList;
	}
	
	function getVenuesforPagination($regionId, $categoryId, $capacityId,$startIndex,$offset) {

		$dbConstants = new DBConstants();
		$dBUtils = new DBUtils();
		$connection = $dBUtils->getDBConnection();
		$venueList = array ();
		//$offset = $dbConstants->pageOffset;TODO
		$dataBaseResponse = "";

		if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
			throw new DBSourceException("Unable to connect to a datasource.");
		} else {
			
			$query = $this->getSearchQueryforPagination($regionId,$categoryId,$capacityId,$startIndex,$offset);
			//echo $query;
			$result = mysql_query($query);

			while ($row = mysql_fetch_array($result)) {

				$venue = new Venue();
				$venue->id = $row['id'];
				$venue->venueId = $row['venueid'];
				$venue->venueName = $row['name'];
				$venue->venueAddr1 = $row['address1'];
				$venue->venueAddr2 = $row['address2'];
				$venue->content = $row['content'];
				$venue->mapUrl = $row['iframe'];
				$venue->altTag = $row['alttag'];
				
				$venueList[] = $venue;
			}
		}

		mysql_close($connection);
		return $venueList;
	}
	
	function getVenue($venueid) {

		$dbConstants = new DBConstants();
		$dBUtils = new DBUtils();
		$connection = $dBUtils->getDBConnection();
		$venueList = array ();

		$dataBaseResponse = "";

		if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
			throw new DBSourceException("Unable to connect to a datasource.");
		} else {
			$result = mysql_query("SELECT ve.*,veseo.title,veseo.meta_description,meta_keyword FROM venue ve LEFT JOIN venue_seo_info veseo ON " .
					"ve.id=veseo.venueid WHERE ve.venueid='".$venueid."' ");
					
					
			while ($row = mysql_fetch_array($result)) {

				$venue = new Venue();
				$venue->id = $row['id'];
				$venue->venueId = $row['venueid'];
				$venue->rank = $row['rank'];
				$venue->venueName = $row['name'];
				$venue->venueAddr1 = $row['address1'];
				$venue->venueAddr2 = $row['address2'];
				$venue->content = $row['content'];
				$venue->mapUrl = $row['iframe'];
				$venue->createdDate = $row['createdate'];
				$venue->updatedDate = $row['updatedate'];
				$venue->iframe = $row['iframe'];
				$venue->title =$row['title'];
				$venue->metaDescription = $row['meta_description'];
				$venue->metaKeyword = $row['meta_keyword'];
				$venueList[] = $venue;
			}
		}

		mysql_close($connection);
		return $venueList;
	}
	
	function deleteVenue($venueId){
		
		$dbConstants = new DBConstants();
		$dBUtils = new DBUtils();
		$connection = $dBUtils->getDBConnection();
		$venueList = array ();

		$dataBaseResponse = "";

		if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
			throw new DBSourceException("Unable to connect to a datasource.");
		} else {

			$result = mysql_query("delete from venue where venueid='".$venueId."'");
		}

		mysql_close($connection);
		return $result;
	}
	
	function updateVenue($venue){
		
		$dbConstants = new DBConstants();
		$dBUtils = new DBUtils();
		$connection = $dBUtils->getDBConnection();
		$venueList = array ();

		$dataBaseResponse = "";

		if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
			throw new DBSourceException("Unable to connect to a datasource.");
		} else {

			$query = "UPDATE venue SET venueid = \"".$venue->venueId."\", NAME=\"".$venue->venueName."\",address1=\"".$venue->venueAddr1."\", " .
					" address2=\"".$venue->venueAddr2."\", content=\"".$venue->content."\", updatedate='".mysql_real_escape_string($venue->updatedDate)."'".
					",iframe=\"".$venue->iframe."\" WHERE id='".$venue->id."'";
			//echo $query;
					
			$dataBaseResponse = mysql_query($query) or die(mysql_error());
			
			if($dataBaseResponse == 1){
				$seoInfoUpdateQuery = "UPDATE venue_seo_info SET title='".$venue->title."'," .
									  "meta_description='".$venue->metaDescription."',meta_keyword='".$venue->metaKeyword."'" .
									  " where venueid=".$venue->id;
									  
				$seoInfoInsertQuery = "INSERT venue_seo_info  VALUES(".$venue->id.",'".$venue->title."'," .
									  "'".$venue->metaDescription."','".$venue->metaKeyword."' )" ;
									  
				$isVenueIdExistQuery = "SELECT venueid from venue_seo_info where venueid=".$venue->id;
				
				$isVenueIdExistResult = mysql_query($isVenueIdExistQuery);
				if(count(mysql_fetch_array($isVenueIdExistResult))>1){
					$dataBaseResponse = $seoInfoQueryResult = mysql_query($seoInfoUpdateQuery) or die(mysql_error());
				}else{
					$dataBaseResponse = $seoInfoQueryResult = mysql_query($seoInfoInsertQuery) or die(mysql_error());
				}	
														  
			}
		}

		mysql_close($connection);
		return $dataBaseResponse;
	}//function
	

	function submitBookingDetails($name, $email, $date, $function, $contactNumber, $budget) {

		$dbConstants = new DBConstants();
		$dBUtils = new DBUtils();
		$connection = $dBUtils->getDBConnection();
		$venueList = array ();

		$dataBaseResponse = "";

		if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
			throw new DBSourceException("Unable to connect to a datasource.");
		} else {

			$dataBaseResponse = mysql_query("INSERT INTO booking_info " .
			"(name,email,date,function,contact,budget,bookingdate) VALUES" .
			"('" . $name . "','" . $email . "','" . $date . "','" . $function . "','" . $contactNumber . "'," .
			"'" . $budget . "',CURRENT_TIMESTAMP())");
			
			/*echo "INSERT INTO booking_info " .
			"(name,email,date,function,contact,budget,bookingdate) VALUES" .
			"('" . $name . "','" . $email . "','" . $date . "','" . $function . "','" . $contactNumber . "'," .
			"'" . $budget . "',CURRENT_TIMESTAMP())";*/
		}

		mysql_close($connection);

		return $dataBaseResponse;

	}

	function getVenueByChoice($choiceId) {

		$dbConstants = new DBConstants();
		$dBUtils = new DBUtils();
		$connection = $dBUtils->getDBConnection();
		$venueList = array ();

		$dataBaseResponse = "";

		if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
			throw new DBSourceException("Unable to connect to a datasource.");
		} else {
			if ($choiceId != 0) //TODO (hard code choiceId)
				$query = "SELECT ve.name,ve.address1,ve.address2,ve.content,ve.id,ve.venueid FROM venue ve WHERE 
									      ve.popular_choice=" . $choiceId . "ORDER BY ve.rank";
			else
				$query = "SELECT ve.name,ve.address1,ve.address2,ve.content,ve.id,ve.venueid FROM venue ve
										 WHERE ve.popular_choice!=1 AND ve.popular_choice!=2 AND ve.popular_choice!=3 AND 
										 ve.popular_choice!=4 AND ve.popular_choice!=5";  
			$result = mysql_query($query);
			
			echo $query;
			while ($row = mysql_fetch_array($result)) {

				$venue = new Venue();
				$venue->id = $row['id'];
				$venue->venueId = $row['venueid'];
				$venue->venueName = $row['name'];
				$venue->venueAddr1 = $row['address1'];
				$venue->venueAddr2 = $row['address2'];
				$venue->content = $row['content'];
				$venueList[] = $venue;
			}
		}

		mysql_close($connection);
		return $venueList;

	}


	function getVenueByChoiceForPagination($choiceId,$startIndex,$offset) {

		$dbConstants = new DBConstants();
		$dBUtils = new DBUtils();
		$connection = $dBUtils->getDBConnection();
		$venueList = array ();

		$dataBaseResponse = "";

		if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
			throw new DBSourceException("Unable to connect to a datasource.");
		} else {
			if ($choiceId != 0) //TODO (hard code choiceId)
				$query = "SELECT ve.name,ve.address1,ve.address2,ve.content,ve.id,ve.venueid FROM venue ve WHERE 
									      ve.popular_choice=" . $choiceId." limit ".$startIndex.",".$offset ;
			else
				$query = "SELECT ve.name,ve.address1,ve.address2,ve.content,ve.id,ve.venueid FROM venue ve
										 WHERE ve.popular_choice!=1 AND ve.popular_choice!=2 AND ve.popular_choice!=3 AND 
										 ve.popular_choice!=4 AND ve.popular_choice!=5 limit ".$startIndex.",".$offset;  
			$result = mysql_query($query);
			while ($row = mysql_fetch_array($result)) {

				$venue = new Venue();
				$venue->id = $row['id'];
				$venue->venueId = $row['venueid'];
				$venue->venueName = $row['name'];
				$venue->venueAddr1 = $row['address1'];
				$venue->venueAddr2 = $row['address2'];
				$venue->content = $row['content'];
				$venueList[] = $venue;
			}
		}

		mysql_close($connection);
		return $venueList;

	}

	function submitbookNow($name, $email, $contact_no, $preferred_region, $preferred_venue, $preferred_date, $no_of_guests, $budget, $type_of_function) {

		$dbConstants = new DBConstants();
		$dBUtils = new DBUtils();
		$connection = $dBUtils->getDBConnection();
		$venueList = array ();
		$dataBaseResponse = "";

		if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {

			throw new DBSourceException("Unable to connect to a datasource.");

		} else {

			$dataBaseResponse = mysql_query("INSERT INTO book_now (NAME,email,contact_no,preferred_region,preferred_venue,".
			" preferred_date,no_of_guests,budget,type_of_function) VALUES('".$name."',".
			"'".$email."','".$contact_no."','".$preferred_region."','".$preferred_venue."',".
			"'".$preferred_date."','".$no_of_guests."',".
			"'".$budget."','".$type_of_function."')");
			
		}

		mysql_close($connection);
		return $dataBaseResponse;

	}
	
	function submitcontactUs($name,$email,$contact_num,$message){

               $dbConstants = new DBConstants();
               $dBUtils = new DBUtils();
               $connection = $dBUtils->getDBConnection();
               $venueList = array();

               $dataBaseResponse = "";

               if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
                       throw new DBSourceException("Unable to connect to a datasource.");
               } else{

                       $dataBaseResponse = mysql_query("INSERT INTO contact_us " .
                                       "(name,email,contact_num,message) VALUES".
                                       "('".$name."','".$email."','".$contact_num."'," .
                                       "'".$message."')");

               }

               mysql_close($connection);

               return $dataBaseResponse;

       }
       
       function getSearchQuery($regionId,$categoryId,$capacityId){
       	
			$fields = "SELECT v.id,v.venueid,v.name,v.address1,v.address2,v.content,v.iframe".",IFNULL(v.alttag,'') as alttag"." ";
			$entity = "from (SELECT ve.*,vi.alttag FROM"." ". 
					   "venue ve LEFT JOIN venue_image_alttag vi ON ve.id=vi.venueid) v"." ";
			$orderBy = "order by v.id desc"." ";
			$conditionClause = "";
			$isFirstCondition = true;
       		
       			if($regionId!=0){
       				if($isFirstCondition)
    					$conditionClause = "WHERE"." ";
    				else
    					$conditionClause.="AND"." ";
    				$conditionClause.="v.regionid=".$regionId." ";
    				$isFirstCondition = false;
    			}
    			
    			if($categoryId!=0){
    				$entity.=",venue_type_mapping vtm"." ";
    				if($isFirstCondition)
    					$conditionClause = "WHERE"." ";
    				else
    					$conditionClause.="AND"." ";
    				$conditionClause.="vtm.venuetypeid = " .$categoryId." AND v.id=vtm.venueid"." ";
    				$isFirstCondition = false;
    			}
    			
    			if($capacityId!=0){
    				$entity.=",venue_capacity_mapping vcm"." ";
    				if($isFirstCondition)
    					$conditionClause = "WHERE"." ";
    				else
    					$conditionClause.="AND"." ";
    				$conditionClause.="vcm.capacityid=".$capacityId." AND v.id=vcm.venueid"." ";
    				$isFirstCondition = false;
    			}
    				
    			$query = $fields.$entity.$conditionClause.$orderBy;
    			//$query.=" limit ".$pointer.",".$offset;TODO
    			
    			return $query;   			
       }//function
       
        function getSearchQueryforPagination($regionId,$categoryId,$capacityId,$startIndex,$offset){
       	
			$fields = "SELECT v.id,v.venueid,v.name,v.address1,v.address2,v.content,v.iframe".",IFNULL(v.alttag,'') as alttag"." ";
			$entity = "from (SELECT ve.*,vi.alttag FROM"." ". 
					   "venue ve LEFT JOIN venue_image_alttag vi ON ve.id=vi.venueid) v"." ";
			$orderBy = "order by v.id desc"." ";
			$conditionClause = "";
			$isFirstCondition = true;
       		
       			if($regionId!=0){
       				if($isFirstCondition)
    					$conditionClause = "WHERE"." ";
    				else
    					$conditionClause.="AND"." ";
    				$conditionClause.="v.regionid=".$regionId." ";
    				$isFirstCondition = false;
    			}
    			
    			if($categoryId!=0){
    				$entity.=",venue_type_mapping vtm"." ";
    				if($isFirstCondition)
    					$conditionClause = "WHERE"." ";
    				else
    					$conditionClause.="AND"." ";
    				$conditionClause.="vtm.venuetypeid = " .$categoryId." AND v.id=vtm.venueid"." ";
    				$isFirstCondition = false;
    			}
    			
    			if($capacityId!=0){
    				$entity.=",venue_capacity_mapping vcm"." ";
    				if($isFirstCondition)
    					$conditionClause = "WHERE"." ";
    				else
    					$conditionClause.="AND"." ";
    				$conditionClause.="vcm.capacityid=".$capacityId." AND v.id=vcm.venueid"." ";
    				$isFirstCondition = false;
    			}
    				
    			$query = $fields.$entity.$conditionClause.$orderBy;
    			$query.=" limit ".$startIndex.",".$offset;

				echo "query===".$query;
    			
    			return $query;   			
       }//function
       
       function getSearchRecordSize($regionId,$categoryId,$capacityId){
       	
			$fields = "SELECT count(v.id) as id ";
			$entity = "from venue v"." ";
			$conditionClause = "";
			$isFirstCondition = true;
       		
       			if($regionId!=0){
       				if($isFirstCondition)
    					$conditionClause = "WHERE"." ";
    				else
    					$conditionClause.="AND"." ";
    				$conditionClause.="v.regionid=".$regionId." ";
    				$isFirstCondition = false;
    			}
    			
    			if($categoryId!=0){
    				$entity.=",venue_type_mapping vtm"." ";
    				if($isFirstCondition)
    					$conditionClause = "WHERE"." ";
    				else
    					$conditionClause.="AND"." ";
    				$conditionClause.="vtm.venuetypeid = " .$categoryId." AND v.id=vtm.venueid"." ";
    				$isFirstCondition = false;
    			}
    			
    			if($capacityId!=0){
    				$entity.=",venue_capacity_mapping vcm"." ";
    				if($isFirstCondition)
    					$conditionClause = "WHERE"." ";
    				else
    					$conditionClause.="AND"." ";
    				$conditionClause.="vcm.capacityid=".$capacityId." AND v.id=vcm.venueid"." ";
    				$isFirstCondition = false;
    			}
    				
    			$query = $fields.$entity.$conditionClause;
    			
    		   $dbConstants = new DBConstants();
               $dBUtils = new DBUtils();
               $connection = $dBUtils->getDBConnection();
               $venueList = array();

               $dataBaseResponse = "";

               if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
                       throw new DBSourceException("Unable to connect to a datasource.");
               } else{
               	
               		$result = mysql_query($query);
               		while ($row = mysql_fetch_array($result)) {
               		
               			$dataBaseResponse = $row['id'];
               		}
               }

               mysql_close($connection);
               return $dataBaseResponse;
    			
       }//function
	
	function getRegionList(){
		
		$dbConstants = new DBConstants();
		$dBUtils = new DBUtils();
		$connection = $dBUtils->getDBConnection();
		$regionList = array ();


		if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
			throw new DBSourceException("Unable to connect to a datasource.");
		} else {

			$result = mysql_query("SELECT * from region" );
				while ($row = mysql_fetch_array($result)) {

				$region = new Region();
				$region->regionId = $row['regionid'];
				$region->regionName = $row['regionname'];
				$regionList[] = $region;
			}
		}

		mysql_close($connection);
		return $regionList;
	}//function
	
	function getRegionByRegionType($regionType){
		
		$dbConstants = new DBConstants();
		$dBUtils = new DBUtils();
		$connection = $dBUtils->getDBConnection();
		$regionName = "";


		if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
			throw new DBSourceException("Unable to connect to a datasource.");
		} else {

			$result = mysql_query("SELECT * from region where regiontype='".$regionType."'");
				while ($row = mysql_fetch_array($result)) {
					$regionName = $row['regionname'];	
				}
		}

		mysql_close($connection);
		return $regionName;
	}//function
	
	function getVenueTypeList(){
		
		$dbConstants = new DBConstants();
		$dBUtils = new DBUtils();
		$connection = $dBUtils->getDBConnection();
		$venueTypeList = array ();


		if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
			throw new DBSourceException("Unable to connect to a datasource.");
		} else {

			$result = mysql_query("SELECT * from venuetype" );
				while ($row = mysql_fetch_array($result)) {

				$venueType = new VenueType();
				$venueType->venueTypeId = $row['venuetypeid'];
				$venueType->venueTypeName = $row['type'];
				$venueTypeList[] = $venueType;
			}
		}

		mysql_close($connection);
		return $venueTypeList;
	}//function
	
	function getVenueByVenueType($venueType){
		
		$dbConstants = new DBConstants();
		$dBUtils = new DBUtils();
		$connection = $dBUtils->getDBConnection();
		$venue = "";


		if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
			throw new DBSourceException("Unable to connect to a datasource.");
		} else {

			$result = mysql_query("SELECT * from venuetype where venuetype='".$venueType."'");
				while ($row = mysql_fetch_array($result)) {
					$venue = $row['type'];
			}
		}

		mysql_close($connection);
		return $venue;
	}//function
	
	function getCapacityList(){
		
		$dbConstants = new DBConstants();
		$dBUtils = new DBUtils();
		$connection = $dBUtils->getDBConnection();
		$capacityList = array ();


		if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
			throw new DBSourceException("Unable to connect to a datasource.");
		} else {

			$result = mysql_query("SELECT * from capacity" );
				while ($row = mysql_fetch_array($result)) {

				$capacity = new Capacity();
				$capacity->capacityId = $row['capacityid'];
				$capacity->capacityRange = $row['range'];
				$capacityList[] = $capacity;
			}
		}

		mysql_close($connection);
		return $capacityList;
	}//function
	
	function getCapacityById($capacityId){
		
		$dbConstants = new DBConstants();
		$dBUtils = new DBUtils();
		$connection = $dBUtils->getDBConnection();
		$capacityRange = "";


		if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
			throw new DBSourceException("Unable to connect to a datasource.");
		} else {

			$result = mysql_query("SELECT * from capacity where capacityid=".$capacityId);
			while ($row = mysql_fetch_array($result)) {
					$capacityRange = $row['range'];	
			}
		}

		mysql_close($connection);
		return $capacityRange;
	}//function
	
	function getRegionIdByRegionType($regionType){
		
		$dbConstants = new DBConstants();
		$dBUtils = new DBUtils();
		$connection = $dBUtils->getDBConnection();
		$regionId = "";
		if($regionType=="delhi-ncr"){
			$regionId = "0";
		}
		else{
			if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
			throw new DBSourceException("Unable to connect to a datasource.");
			} else {
				$result = mysql_query("SELECT regionid from region where regiontype='".$regionType."'");
				while ($row = mysql_fetch_array($result)) {
						$regionId = $row['regionid'];	
				}
			}
			
		}
		
		mysql_close($connection);
		return $regionId;
	}//function
	
	function getVenueTypeIdByVenueType($venueType){
		
		$dbConstants = new DBConstants();
		$dBUtils = new DBUtils();
		$connection = $dBUtils->getDBConnection();
		$venueTypeId = "";
		
		if($venueType == "wedding-venues"){
			$venueTypeId = "0";
		}else{
			if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
				throw new DBSourceException("Unable to connect to a datasource.");
			} else {
	
				$result = mysql_query("SELECT venuetypeid from venuetype where venuetype='".$venueType."'");
				while ($row = mysql_fetch_array($result)) {
						$venueTypeId = $row['venuetypeid'];	
				}
			}
		}

		mysql_close($connection);
		return $venueTypeId;
	}//function
	
	function getPopularChoiceList(){
		
		$dbConstants = new DBConstants();
		$dBUtils = new DBUtils();
		$connection = $dBUtils->getDBConnection();
		$popularChoiceList = array ();


		if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
			throw new DBSourceException("Unable to connect to a datasource.");
		} else {

			$result = mysql_query("SELECT * from popular_choice" );
				while ($row = mysql_fetch_array($result)) {

				$popularChoice = new PopularChoice();
				$popularChoice->popularChoiceId = $row['popularchoiceid'];
				$popularChoice->popularChoiceName = $row['popularchoicename'];
				$popularChoiceList[] = $popularChoice;
			}
		}

		mysql_close($connection);
		return $popularChoiceList;
	}//function
	
	function insertIntoVenueEntity($venue){
		
		$dbConstants = new DBConstants();
		$seoConstants = new SEOConstants();
		$dBUtils = new DBUtils();
		$connection = $dBUtils->getDBConnection();
		$popularChoiceList = array ();

		if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
			throw new DBSourceException("Unable to connect to a datasource.");
		} else {

			$query = "INSERT INTO venue(venueid,NAME,address1,address2,content,iframe,createdate,regionid,popular_choice)
					 VALUES ('".$venue->venueId."','".$venue->venueName."','".$venue->venueAddr1."'," .
					 		" '".$venue->venueAddr2."','".$venue->content."','".mysql_real_escape_string($venue->iframe)."',
					'".date("Y-m-d")."',".$venue->regionId.",".$venue->popularChoiceId.")";
					
			$result = mysql_query($query) or die(mysql_error());
			
			$status = false;
			
			if($result==1 ){
				
				$getIdQuery = "select id from venue where venueid='".$venue->venueId."'";
				$getIdQueryResult = mysql_query($getIdQuery);
				$id = 0;
				while($row = mysql_fetch_array($getIdQueryResult)){
					$id = $row['id'];
				}
				
				if($id!=null && $id!=0)
					$status = $this->insertIntoVenueTypeMappingEntity($id,$venue->venueTypeIdList);
				if($status)	
					$status = $this->insertIntoVenueCapacityMappingEntity($id,$venue->venueTypeIdList);
				if($status)	
					$status = $this->insertIntoSEOInfoMappingEtity($id,mysql_real_escape_string($seoConstants->defaulTitle),
							  mysql_real_escape_string($seoConstants->defaulMetaDescription),mysql_real_escape_string($seoConstants->defaulMetaKeyword));
			}
			mysql_close($connection);
			if($status)
				return $id;
			else
				return "fail";
				
		}
	}//function
	
	
	function insertIntoVenueTypeMappingEntity($id,$venueTypeIdList){
		
		$query = "INSERT INTO venue_type_mapping(venueid,venuetypeid) VALUES ";
		for($i=0;$i<count($venueTypeIdList);$i++){
			$query.=" (".$id.",".$venueTypeIdList[$i].") ,";
		}//for
		$query = substr($query,0,strlen($query)-1);
		$result = mysql_query($query) or die(mysql_error());
		
		if($result==1)
			return true;
		else
			return false;
			
	}//function
	
	function insertIntoSEOInfoMappingEtity($id,$title,$metaDescription,$metaKeyword){
		
		$seoInfoQuery = "INSERT INTO venue_seo_info VALUES('".$id."','".$title."','".$metaDescription."'," .
						"'".$metaKeyword."')";
		$seoInfoQueryResult = mysql_query($seoInfoQuery) or die(mysql_error());
		
		if($seoInfoQueryResult==1)
			return true;
		else
			return false;
	}//function
	
	function insertIntoVenueCapacityMappingEntity($id,$venueCapacityIdList){
		
		$query = "INSERT INTO venue_capacity_mapping(venueid,capacityid) VALUES ";
		for($i=0;$i<count($venueCapacityIdList);$i++){
			$query.=" (".$id.",".$venueCapacityIdList[$i].") ,";
		}//for
		$query = substr($query,0,strlen($query)-1);
		$result = mysql_query($query) or die(mysql_error());
		
		if($result==1)
			return true;
		else
			return false;
			
	}//function
	
	function isValidUser($userId,$password,$roleId){
		
		$dbConstants = new DBConstants();
		$dBUtils = new DBUtils();
		$connection = $dBUtils->getDBConnection();
		$popularChoiceList = array ();


		if (!(mysql_select_db($dbConstants->DATABASE, $connection))) {
			throw new DBSourceException("Unable to connect to a datasource.");
		} else {
			
			$query = "select * from userinfo where userid='".$userId."' and password = '".$password."' " .
					" and roleid='".$roleId."' ";
			$result = mysql_query($query);
			
			if(count(mysql_fetch_array($result))>1)
				return true;
			else
				return false;
			
		}

		mysql_close($connection);
	}//function
	
}

?>