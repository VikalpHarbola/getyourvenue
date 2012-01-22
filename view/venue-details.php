<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
require_once ("../database/GetYourVenueMySQLManager.php"); 
require_once ("../service/VenueService.php");
?>
<?php
           		$venueid=$_GET['venueid'];
           		$databaseManager=new GetYourVenueMySQLManager();
           		$venueList=$databaseManager->getVenue($venueid);
           		
           		/*echo "<h3>".$venueList[0]->venueName."</h3><p>";
				echo $venueList[0]->venueAddr1."<br/>";
				echo $venueList[0]->venueAddr2."<br/>";
				echo $venueList[0]->content."<br/>";*/
  ?>
<link rel="stylesheet" href="../css/calendar.css">
<script language="javascript" src="../js/calendar_us.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

$venueService = new VenueService();
echo $venueService->getSEOConstant("venueDetails",$venueList[0]);

?>
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<script type="text/javascript" src="../js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.nivo.slider.pack.js"></script>
</head>
<body>
<div id="wrapper">
  <div id="main">
    <?php  require("../view/header.php") ?>
    <div id="contentArea">
      <div id="leftNavNarrow">
        <!-- Small Left Box Start -->
        <div class="box">
          <div class="boxtop"><img src="../images/boxtopc1.png" align="left" alt="" /><img src="../images/boxtopc2.png" align="right" alt="" />
            <div class="boxtopbg sml"></div>
          </div>
          <div class="fullboxBg">
            <div class="boxContent">
              <div class="boxGr">
                <!-- Box Content Start -->
                <h4>Popular Choices</h4>
                <div class="venCatSml"><a href="/wedding-venues-in-chhatarpur"><img src="/images/icons/inner/chhatarpur.jpg" alt=" Wedding farm houses chhatarpur, Banquet halls chhatarpur" /></a> <span class="pcNamein"><a class="catName" href="/wedding-venues-in-chhatarpur">Chhatarpur &amp; MG Road</a></span>
                  <!--<br />
                  <a href="/wedding-venues-in-chhatarpur" class="moreCat">View Options</a>-->
                </div>
                <div class="venCatSml"><a href="/wedding-venues-in-gt-karnal-road"><img src="/images/icons/inner/gt_karnal.jpg" alt=" Wedding farm houses GT Karnal Road, Banquet halls GT Karnal Road" /></a> <span class="pcNamein"><a class="catName" href="/wedding-venues-in-gt-karnal-road">GT Karnal Road</a></span>
                  <!--<br />
                  <a href="/wedding-venues-in-gt-karnal-road" class="moreCat">View Options</a>-->
                </div>
                <div class="venCatSml"><a href="/wedding-venues-in-NH8-Pushpanjali"><img src="/images/icons/inner/nh8.jpg" alt=" Wedding farm houses NH8, Banquet halls NH 8, Banquets on NH 8" /></a> <span class="pcNamein"><a class="catName" href="/wedding-venues-in-NH8-Pushpanjali">NH-8 &amp; Pushpanjali</a></span>
                  <!--<br />
                  <a href="/wedding-venues-in-NH8-Pushpanjali" class="moreCat">View Options</a>-->
                </div>
                <div class="venCatSml"><a href="/wedding-venues-in-Vaishali-Vasundhara"><img src="/images/icons/inner/vaishali.jpg" alt=" Wedding farm houses Vaishali Vasundhara, Banquet halls Vaishali Vasundhara" /></a> <span class="pcNamein"><a class="catName" href="/wedding-venues-in-Vaishali-Vasundhara">Vaishali &amp; Vasundhara</a></span>
                  <!--<br />
                  <a href="/wedding-venues-in-Vaishali-Vasundhara" class="moreCat">View Options</a>-->
                </div>
                <div class="venCatSml"><a href="/wedding-venues-in-mundka"><img src="/images/icons/inner/mundaka.jpg" alt=" Wedding farm houses Mundka, Banquet halls Mundka " /></a> <span class="pcNamein"><a class="catName"  href="/wedding-venues-in-mundka">Mundka</a></span>
                  <!--<br />
                  <a href="/wedding-venues-in-mundka" class="moreCat">View Options</a>-->
                </div>
                <div class="venCatSml"><a href="/wedding-venues-in-delhi-NCR"><img src="/images/icons/inner/others.jpg" alt="" /></a> <span class="pcNamein"><a class="catName" href="/wedding-venues-in-delhi-NCR">Others</a></span>
                  <!--<br />
                  <a href="/wedding-venues-in-delhi-NCR" class="moreCat">View Options</a>-->
                </div>
                <!-- Box Content End -->
              </div>
            </div>
          </div>
          <div class="boxbot"><img src="../images/boxbotc3.png" align="left" alt="" /><img src="../images/boxbotc4.png" align="right" alt="" /><img src="../images/flower.png" class="flower" alt="" />
            <div class="boxbotbg sml"></div>
          </div>
        </div>
        <!-- Small Left Box End -->
                <!-- Small Left Box Start -->
        <div class="box">
          <div class="boxtop"><img src="/images/boxtopc1.png" align="left" alt="" /><img src="/images/boxtopc2.png" align="right" alt="" />
            <div class="boxtopbg sml"></div>
          </div>
          <div class="fullboxBg">
            <div class="boxContent">
              <div class="boxGr" align="center">
                <!-- Box Content Start -->
                <script type="text/javascript"><!--
google_ad_client = "ca-pub-4918915311035756";
/* Side Panels */
google_ad_slot = "6847862507";
google_ad_width = 120;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
                <!-- Box Content End -->
              </div>
            </div>
          </div>
          <div class="boxbot"><img src="/images/boxbotc3.png" align="left" alt="" /><img src="/images/boxbotc4.png" align="right" alt="" />
            <div class="boxbotbg sml"></div>
          </div>
        </div>
        <!-- Small Left Box End -->
      </div>
      <div id="rightNavWide">
        <!-- Box Start -->
        <a name="location"></a>
        <div class="box">
          <div class="boxtop"><img src="../images/boxtopc1.png" align="left" alt="" /><img src="../images/boxtopc2.png" align="right" alt="" />
            <div class="boxtopbg"></div>
          </div>
          <div class="fullboxBg">
            <div class="boxContent">
              <div class="boxGr relative">
                <!-- Box Content Start -->
                <h3><?php echo $venueList[0]->venueName?></h3>
                <!--
                <div class="likebuttons">
                  <iframe src="http://www.facebook.com/plugins/like.php?href=&layout=button_count&show_faces=false&width=80&action=like&font=lucida+grande&colorscheme=light" allowtransparency="true" style="border: medium none; overflow: hidden; width: 80px; height: 21px;" frameborder="0" scrolling="no"></iframe>
                  <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a>
                  <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                </div>
                -->
                <br />
                <div class="venue-desc f-left"> <img src="<?php echo '../images/'.$venueList[0]->id.'/thumbnail.jpg' ?>" alt="" />
                  <div class="addressLine"><?php echo $venueList[0]->venueAddr1?><br />
                    <?php echo $venueList[0]->venueAddr2?></div>
                </div>
                
                <div class="google-map f-right">
                <iframe width='560' height='310' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src=
                 	'<?php echo $venueList[0]->mapUrl?>'>
                 </iframe>
                  <br /> 
              </div>
            </div>
          </div>
          <div class="boxbot"><img src="../images/boxbotc3.png" align="left" alt="" /><img src="../images/boxbotc4.png" align="right" alt="" />
            <div class="boxbotbg"></div>
          </div>
        </div>
        <!-- Box End -->
        <!-- Box Start -->
        <div class="box">
          <div class="boxtop"><img src="../images/boxtopc1.png" align="left" alt="" /><img src="../images/boxtopc2.png" align="right" alt="" />
            <div class="boxtopbg"></div>
          </div>
          <div class="fullboxBg">
            <div class="boxContent">
              <div class="boxGr">
                <!-- Box Content Start -->
                <a name="imageGallery"></a>
                <h3>Latest Gallery</h3>
                <div class="image-slider f-left">
                  <div class="slider-wrapper theme-default">
                    <div class="ribbon"></div>
                    <div id="slider" class="nivoSlider"> <img src="<?php echo "../images/".$venueList[0]->id."/gal_1.jpg" ?>"   alt="" /> <img src="<?php echo "../images/".$venueList[0]->id."/gal_2.jpg" ?>"  alt="" /> <img src="<?php echo "../images/".$venueList[0]->id."/gal_3.jpg" ?>"  alt="" /> <img src="<?php echo "../images/".$venueList[0]->id."/gal_4.jpg" ?>" alt="" /> </div>
                  </div>
                </div>
                <div class="latest-news f-right">
                  <p><?php echo $venueList[0]->content?></p>
                </div>
                <!-- Box Content End -->
              </div>
            </div>
          </div>
          <div class="boxbot"><img src="../images/boxbotc3.png" align="left" alt="" /><img src="../images/boxbotc4.png" align="right" alt="" />
            <div class="boxbotbg"></div>
          </div>
        </div>
        <!-- Box End -->
        <!-- Box Start -->
        <div class="box">
          <div class="boxtop"><img src="../images/boxtopc1.png" align="left" alt="" /> <img src="../images/boxtopc2.png" align="right" alt="" />
            <div class="boxtopbg"></div>
          </div>
          <div class="fullboxBg">
            <div class="boxContent">
              <div class="boxGr">
                <!-- Box Content Start -->
                <a name="bookNow"></a>
                <h3>Get This Venue Now</h3>
                <div id='errorMessages'></div>
                <form class="getVenue" name="bookVenueForm" method="POST">
                  <!-- action="booking-confirmation"-->
                  <div class="getvenue_cont">
                    <label>Name:</label>
                    <input type="text" name="name" class="txt-name" value="Enter Your Name" onblur="if(this.value==''){this.value='Enter Your Name'}" onfocus="if(this.value=='Enter Your Name'){this.value=''}"  />
                  </div>
                  <div class="getvenue_cont">
                    <label>Email:<font color="red">*</font></label>
                    <input type="text" name="email" class="txt-name" value="Enter your Email Id" onblur="if(this.value==''){this.value='Enter your Email Id'}" onfocus="if(this.value=='Enter your Email Id'){this.value=''}"  />
                  </div>
                  <div class="getvenue_cont last">
                    <label>Contact Number:<font color="red">*</font></label>
                    <input type="text" name="contactNumber" class="txt-name" value="Enter your Contact Number" onblur="if(this.value==''){this.value='Enter your Contact Number'}" onfocus="if(this.value=='Enter your Contact Number'){this.value=''}"  />
                  </div>
                  <!--<div class="getvenue_cont">
                   <label>Preferred Date:</label>
                    <input type="text" name="date" class="txt-name" value="Select your Date" onblur="if(this.value==''){this.value='Select your Date'}" onfocus="if(this.value=='Select your Date'){this.value=''}"  />
                    <a href="#"><img src="../images/cal-icon.png" alt="" class="calicon" /></a> </div>
                   -->
                  <div class="getvenue_cont">
                    <label>Preferred Date:</label>
                    <input type="text" class="txt-name" name="date" value="" />
                    <script language="JavaScript">

						new tcal ({
							// form name
							'formname': 'bookVenueForm',
							// input name
							'controlname': 'date',
						});
						</script>
                  </div>
                  <div class="getvenue_cont">
                    <label>Your Function:</label>
                    <input type="text" name="function" class="txt-name" value="Enter your Function" onblur="if(this.value==''){this.value='Enter your Function'}" onfocus="if(this.value=='Enter your Function'){this.value=''}"  />
                  </div>
                  <div class="getvenue_cont last">
                    <label>Your Budget in INR:</label>
                    <input type="text" name="budget" class="txt-name" value="Enter your Budget" onblur="if(this.value==''){this.value='Enter your Budget'}" onfocus="if(this.value=='Enter your Budget'){this.value=''}"  />
                  </div>
                  <!--
                  <div class="getvenue_cont">
                    <center>
                      <br>
                      <img src="../EasyCaptcha/easycaptcha.php" />
                    </center>
                  </div>
                  <div class="getvenue_cont">
                    <label>Enter code of the image:<font color="red">*</font></label>
                    <input type="text" class="txt-name" name="confirm_code"  />
                  </div>
                  -->
                  <div class="clear"></div>
                  <br>
                  <div class="getvenue_cont last">
                    <input type="image" src="../images/go-btn.png"  onClick="return submitVenueBookingForm()"/>
                  </div>
                  <input type="hidden" name="action" value="bookVenue"  />
                  <input type="hidden" name="venueId" value="<?php echo $venueList[0]->venueId  ?>" />
                </form>
                <!-- Box Content End -->
              </div>
            </div>
          </div>
          <div class="boxbot"><img src="../images/boxbotc3.png" align="left" alt="" /> <img src="../images/boxbotc4.png" align="right" alt="" />
            <div class="boxbotbg"></div>
          </div>
        </div>
        <!-- Box End -->
      </div>
    </div><br class="clear"/>
        <!-- Box Start -->
        <div class="box">
          <div class="boxtop"><img src="/images/boxtopc1.png" align="left" alt="" /><img src="/images/boxtopc2.png" align="right" alt="" />
            <div class="boxtopbg"></div>
          </div>
          <div class="fullboxBg">
            <div class="boxContent">
              <div class="boxGr">
                <!-- Box Content Start -->
                
                <div class="google-adds">
                  <script type="text/javascript"><!--
					google_ad_client = "ca-pub-4918915311035756";
					/* My Ad */
					google_ad_slot = "1466171534";
					google_ad_width = 728;
					google_ad_height = 90;
					//-->
					</script>
					<script type="text/javascript"
					src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
					</script>
                </div>
                <!-- Box Content End -->
              </div>
            </div>
          </div>
          <div class="boxbot"><img src="/images/boxbotc3.png" align="left" alt="" /><img src="/images/boxbotc4.png" align="right" alt="" /><img src="/images/flower.png" class="flower" alt="" />
            <div class="boxbotbg"></div>
          </div>
        </div>
        <!-- Box End -->
    <?php  require("../view/footer.php") ?>
  </div>
</div>
<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider({
		effect:'random', 
        slices:17,
        animSpeed:500,
        pauseTime:6000,
        startSlide:0, //Set starting Slide (0 index)
        directionNav:true, //Next & Prev
        directionNavHide:false, //Only show on hover
        controlNav:true, //1,2,3...
        controlNavThumbs:false, //Use thumbnails for Control Nav
        controlNavThumbsFromRel:false, //Use image rel for thumbs
        controlNavThumbsSearch: '.jpg', //Replace this with...
        controlNavThumbsReplace: '_thumb.jpg', //...this in thumb Image src
        keyboardNav:true, //Use left & right arrows
        pauseOnHover:true, //Stop animation while hovering
        manualAdvance:false, //Force manual transitions
        captionOpacity:0
		});
    });
    </script>
</body>
</html>
