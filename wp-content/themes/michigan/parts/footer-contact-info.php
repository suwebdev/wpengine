<?php
$michigan_webnus_options = michigan_webnus_options();
$fci_address = $michigan_webnus_options['michigan_webnus_footer_contact_address'];
$fci_email = $michigan_webnus_options['michigan_webnus_footer_contact_email'];
$fci_phone = $michigan_webnus_options['michigan_webnus_footer_contact_phone'];

$count=0;
if($fci_address)
$count++;
if($fci_email)
$count++;
if($fci_phone)
$count++;
if ($count==1)
$col = 12;
elseif ($count==2)
$col = 6;
elseif ($count==3)
$col = 4;
if ($count){
	echo '<section class="footer-contact-info"><div class="container">';
	echo '<div class="col-md-'.$col.' clearfix"><i class="sl-location-pin"></i><span>'.$fci_address.'</span></div>';
	echo '<div class="col-md-'.$col.' clearfix"><i class="sl-envelope-open"></i><span>'.$fci_email.'</span></div>';
	echo '<div class="col-md-'.$col.' clearfix"><i class="sl-phone"></i><span>'.$fci_phone.'</span></div>';
	echo '</div></section>';
}

