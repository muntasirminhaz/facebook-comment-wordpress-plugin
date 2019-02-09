<?php

$data = $wpdb->get_results($wpdb->prepare('SELECT fbsetup FROM ' . $fbtable . ' where id=%d', $ids), ARRAY_A);
$allData = explode("|", $data[0]['fbsetup']);

$jsSDK = "
<div id=\"fb - root\"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&$allData[0]';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
";

$comBox = "<div
class=\"fb-comments\"
data-href=\"$postURL\"
data-numposts=\"$allData[1]\"
data-width=\"$allData[2]px\"
 ";

if ($allData[3] == 1) {
    $comBox .= "data-order-by=\"social\"";
} elseif ($allData[3] == 2) {
    $comBox .= "data-order-by=\"reverse_time\"";
} elseif ($allData[3] == 3) {
    $comBox .= "data-order-by=\"time\"";
}

if ($allData[4] == 1) {
    $comBox .= "data-colorscheme=\"light\"";
} elseif ($allData[4] == 2) {
    $comBox .= "data-colorscheme=\"dark\"";
}

$comBox .= "></div>";

$output .= $jsSDK . $comBox;
