@@include('../../templates/header.tpl.html')
<!--page-->
<div id="banner">
    <div class="container intro_wrapper">
        <div class="inner_content">
            <h1>Online Journal</h1>
            <h1 class="title">
						ACM Events
					</h1>
            <h1 class="intro">
					Brought to you by the <span class="hue">Events Team</span>, at <span>UC Merced's Association of Computing Machinery</span>
				</h1>
        </div>
    </div>
</div>

<div class="container wrapper">
    <div class="inner_content">
        <div class="row pad30">

            <!--col 1-->
            <div class="col-md-9 pad25">
                <div class="row">
<?php               

					$template = "
					<!--date-->
					<div class='col-md-1 hidden-xs hidden-sm'>
						<div class='btn btn-medium btn-rounded btn-blog1'>
							%event_day%
							<br>%event_month%
							<br>
							<i class='fa fa-comments fa-2x'></i>
							<br>
						</div>
					</div>
					<div class='col-md-1 hidden-lg hidden-md'>
						<div class='btn btn-medium btn-rounded btn-blog2'>
							%event_day% %event_month% <i class='fa fa-comments fa-2x'></i>
						</div>
					</div>
					<!--post entry-->
					<div class='col-md-11'>
						<div class='hover_img'>
							<a href='/assets/img/large/4.jpg' data-rel='prettyPhoto'>
								<img src='/assets/img/large/4.jpg' alt=''>
							</a>
						</div>
						<h1 class='post_link'>
							<a href='%event_url%'>%event_name%</a>
						</h1>
						<div class='post-meta muted'>
							<ul>
								<li>Posted by <a href='#'>Bot</a>
									<em> on %event_month% %event_day%, %event_year%</em>
								</li>
							</ul>
						</div>
						<p>
							%event_description%
						</p>
						<div class='read_more'><a href='3'>READ MORE &rarr;</a>
						</div>
						<div class='pad30'></div>
					</div>";

$date = new DateTime();

$current_timestamp = $date->getTimestamp();
$db = new mysqli('localhost', 'acm', 'abc123', 'acmevents');

$sql_query = "SELECT id,name,description,start_time,end_time,location,privacy FROM events WHERE end_time > ? OR (end_time = 0 AND start_time > ?);";

if($stmt = $db->prepare($sql_query)) {
    $stmt->bind_param("ii", $current_timestamp, $current_timestamp);
    $stmt->execute();
    $stmt->bind_result($event_id, $event_name, $event_description, $event_start_time, $event_end_time, $event_location, $event_privacy);
    while($stmt->fetch()) {
        $event_url = "http://www.facebook.com/events/" . $event_id;
        if($event_end_time == '0') {
            $event_end_time = $event_start_time;
        }
        $event_month = date('M', $event_end_time);
        $event_day = date('d', $event_end_time);
        $event_year = date('Y', $event_end_time);

        $event_html = $template;
        $event_html = str_replace('%event_name%', $event_name, $event_html);
        $event_html = str_replace('%event_month%', $event_month, $event_html);
        $event_html = str_replace('%event_day%', $event_day, $event_html);
        $event_html = str_replace('%event_year%', $event_year, $event_html);
        $event_html = str_replace('%event_description%', $event_description, $event_html);
        $event_html = str_replace('%event_url%', $event_url, $event_html);
        echo $event_html;
    }
    $stmt->close();
}
?>
                </div>
            </div>

            <!--sidebar-->
            <div class="sidebar col-md-3">

                <h3>About Us</h3>
                <h5>At UCMerced ACM we strive to bring quality events to the community of UCMerced.</h5>

                <h3 class="pad15">Categories</h3>
                <ul class="fa-ul">
                    <li><i class="fa-li fa fa-caret-right grey2"></i><a href="index.php">All</a>
                    <li><i class="fa-li fa fa-caret-right grey2"></i><a href="index.php?category=CANDC">Coffee and Code</a>
                    </li>
                    <li><i class="fa-li fa fa-caret-right grey2"></i><a href="index.php?category=LAN">LAN Parties</a>
                    </li>
                    <li><i class="fa-li fa fa-caret-right grey2"></i><a href="index.php?category=PROFSEM">Professional Seminar</a>
                    </li>
                    <li><i class="fa-li fa fa-caret-right grey2"></i><a href="index.php?category=EECSSEM">EECS Seminar</a>
                    </li>
                    <li><i class="fa-li fa fa-caret-right grey2"></i><a href="index.php?category=MISC">Miscellaneous</a>
                    </li>
                </ul>
                <div class="pad25"></div>
            </div>
            <div class="pad45"></div>
        </div>
    </div>
</div>
<div class="pad45 hidden-md hidden-lg"></div>
<!--end-->
<!-- footer -->
<div id="footer">
    <h1>get in touch</h1>
    <h3 class="center follow">
                We're social and we'd love to hear from you! Feel free to send us an email, find us on Google Plus, follow us on Twitter and join us on Facebook.
            </h3>
    <div class="follow_us">
        <a href="#" class="fa fa-twitter follow_us"></a>
        <a href="https://www.facebook.com/groups/ucmercedacm/" class="fa fa-facebook follow_us"></a>
        <a href="#" class="fa fa-linkedin follow_us"></a>
        <a href="#" class="fa fa-google-plus follow_us"></a>
        <a href="#" class="fa fa-vimeo-square follow_us"></a>
    </div>
</div>

<!-- footer 2 -->
<div id="footer2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                    FLATI &copy;
                    <script type="text/javascript">
                    //<![CDATA[
                    var d = new Date()
                    document.write(d.getFullYear())
                        //]]>
                    </script>
                    - All Rights Reserved : Template by <a href="http://spiralpixel.com">Spiral Pixel</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- up to top -->
<a href="#"><i class="go-top fa fa-angle-double-up"></i></a>

<!--end-->
@@include('../../templates/footer.tpl.html')
