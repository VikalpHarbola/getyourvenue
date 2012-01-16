<?php
/*
 * Created on Jul 7, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>


<?php

class Venue {
	
	var $id;
	var $venueId;
	var $venueName;
	var $rank;
	var $venueAddr1;
	var $venueAddr2;
	var $content;
	var $mapUrl;
	var $createdDate;
	var $updatedDate;
	var $regionId;
	var $venueTypeIdList = array();
	var $capacityIdList = array();
	var $popularChoiceId;
	var $iframe;
	var $title;
	var $metaDescription;//used for SEO
	var $metaKeyword;//used for SEO
	var $altTag;
	
	public function getVenueName() {

		return $this->venueName;
	}

	public function setVenueName($venueName) {

		$this->venueName = $venueName;
	}
	
	public function getRank() {

		return $this->rank;
	}

	public function setRank($rank) {

		$this->rank = $rank;
	}
	
	public function getVenueAddr1() {

		return $this->venueAddr1;
	}

	public function setVenueAddr1($venueAddr1) {

		$this->venueAddr1 = $venueAddr1;
	}
	
	
	public function getVenueAddr2() {

		return $this->venueAddr2;;
	}

	public function setVenueAddr2($venueAddr2) {

		$this->venueAddr2 = $venueAddr2;
	}
	
	public function getcreatedDate() {

		return $this->createdDate;
	}

	public function setcreatedDate($createdDate) {

		$this->createdDate = $createdDate;
	}
	
	public function getupdatedDate() {

		return $this->updatedDate;
	}

	public function setupdatedDate($updatedDate) {

		$this->updatedDate = $updatedDate;
	}
	public function getTitle() {

		return $this->title;
	}

	public function setTitle($title) {

		$this->title = $title;
	}
	public function getMetaDescription() {

		return $this->metaDescription;
	}

	public function setMetaDescription($metaDescription) {

		$this->metaDescription = $metaDescription;
	}
	public function getMetaKeyword() {

		return $this->metaKeyword;
	}

	public function setMetaKeyword($metaKeyword) {

		$this->metaKeyword = $metaKeyword;
	}
	
	public function getAltTag() {

		return $this->altTag;
	}

	public function setAltTag($alttag) {

		$this->altTag = $alttag;
	}
}

?>