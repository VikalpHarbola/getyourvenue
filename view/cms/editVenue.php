<?php
/*
 * Created on Jul 21, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<h2>Edit Venue</h2><hr><br>
<table>
	<form id="venueInfo" method="post" action="../actionController/CSMController.php">
	<tr>
		<td width="20%">id:</td>
		<td><input type="text" value="<?php echo $venueList[0]->id ?>" disabled></td>
		<input type="hidden" name="id" value="<?php echo $venueList[0]->id ?>">
	</tr>
	
	<tr>
		<td width="20%">SEOId:</td>
		<td><input type="text" name="venueid" value="<?php echo $venueList[0]->venueId  ?>" size='50' ></td>
		<input type="hidden"  value="<?php echo $venueList[0]->venueId ?>">
	</tr>
	<tr>
		<td width="20%">Name:</td>
		<td><input type="text" name="name" value="<?php echo $venueList[0]->venueName ?>" size=50></td>
	</tr>
	
	<tr>
		<td width="20%">Rank:</td>
		<td><input type="text" name="rank" value="<?php echo $venueList[0]->rank ?>" size=50></td>
	</tr>
	
	<tr>
		<td width="20%">Addr1:</td>
		<td><textarea name="address1" rows="2" cols="40"><?php echo $venueList[0]->venueAddr1 ?></textarea></td>
	</tr>
	<tr>
		<td width="20%">Addr2:</td>
		<td><textarea name="address2" rows="2" cols="40"><?php echo $venueList[0]->venueAddr2 ?></textarea></td>
	</tr>
	<tr>
		<td width="20%">content:</td>
		<td><textarea name="content" rows="10" cols="70"><?php echo $venueList[0]->content ?></textarea></td>
	</tr>
	</tr>
		<tr>
		<td width="20%">Iframe:</td>
		<td><input type="text" name="iframe" value="<?php echo $venueList[0]->iframe ?>" size='80'></td>
	</tr>
	<tr>
		<td width="20%">Title:</td>
		<td><textarea name="title" rows="2" cols="40"><?php echo $venueList[0]->title ?></textarea></td>
	</tr>
	<tr>
		<td width="20%">MetaDescription:</td>
		<td><textarea name="metadescription" rows="2" cols="40"><?php echo $venueList[0]->metaDescription ?></textarea></td>
	</tr>
	<tr>
		<td width="20%">MetaKeyword:</td>
		<td><textarea name="metakeyword" rows="2" cols="40"><?php echo $venueList[0]->metaKeyword ?></textarea></td>
	</tr>
	<tr>
		<td width="20%">createdDate:</td>
		<td><input type="text" name="name" value="<?php echo $venueList[0]->createdDate ?>" size=50 disabled></td>
	</tr>
	<tr>
		<td width="20%">updatedDate:</td>
		<td><input type="text" name="name" value="<?php echo $venueList[0]->updatedDate ?>" size=50 disabled></td>
	</tr>
	<tr>
		<td width="20%">&nbsp;</td>
		<td >&nbsp;</td>
	</tr>
	<tr>
		<td width="20%">&nbsp;</td>
		<td ><input type="submit" value="submit"></td>
	</tr>
	<input type="hidden" name="action" value="editVenue">
	</form>
</table>
