<?php
if (isset($_POST['sub'])) {

    if ($_POST['appid'] != "") {

        $dataArr = [
            $_POST['appid'], // 0 => facebook app id
            $_POST['numcom'], // 1 => number of comments
            $_POST['width'], // 2 => width of the comment box
            $_POST['ordercoms'], // 3 => order the comments
            $_POST['colorscheme'], // 4 => comment box theme
        ];
        $str = implode("|", $dataArr);

        $nonce = $_REQUEST['_wpnonce'];
        if (!wp_verify_nonce($nonce, 'fb_save_settings')) {
            die('You do not have sufficient permissions to access this page.');
        } else {

            $data = $wpdb->get_results($wpdb->prepare('SELECT id FROM ' . $fbtable . ' where id=%d', $ids), ARRAY_A);

            if ($data[0]['id'] == 1) {
                $deid = 1;

                $wpdb->query(

                    $wpdb->prepare(
                        "UPDATE $fbtable SET id = %d , fbsetup = %s",
                        $ids,
                        sanitize_text_field($str)
                    )
                );

            } else {
                $deid = 1;

                $wpdb->query(

                    $wpdb->prepare(
                        "INSERT INTO $fbtable SET id = %d , fbsetup = %s",
                        $ids,
                        sanitize_text_field($str)
                    )
                );
            }
            echo "Insert Successful";
        }

    } else {
        echo "Settings Not Saved: Facebook App ID Cannot be emply <br>";
    }

}
$data2 = $wpdb->get_results($wpdb->prepare('SELECT fbsetup FROM ' . $fbtable . ' where id=%d', $ids), ARRAY_A);
$allData = explode("|", $data2[0]['fbsetup']);
?>



<form action="#" method="post">
<?php wp_nonce_field("fb_save_settings")?>
<table>
<tr><td colspan="2"><h2>Comment Box Settings</h2></td><td>

<tr>
    <td>Facebook App ID <sup>*</sup> </td>
    <td><input name="appid" type="text" <?php if (isset($allData[0])) {
    echo "value=" . $allData[0];
}?>
></td>
</tr>
<tr>
    <td>Number of comments</td>
    <td><input name="numcom" type="number"  <?php if (isset($allData[1])) {
    echo "value=" . $allData[1];
} else {
    echo "value=10";
}?>></td>
</tr>
<tr>
    <td>Width</td>
    <td><input name="width" type="number"  <?php if (isset($allData[2])) {
    echo "value=" . $allData[2];
} else {
    echo "100%";
}
?>></td>
</tr>
<tr>
    <td>Order Comments By</td>
    <td>
    <select name="ordercoms">
    <?php
if (isset($allData[3])) {
    $ordercoms = $allData[3];

} else {
    $ordercoms = 1;
}
?>
        <option <?php if ($ordercoms == 1) {
    echo "selected";
}?> value='1'>Top Comments(Social)</option>
        <option <?php if ($ordercoms == 2) {
    echo "selected";
}?> value='2'>Latest Comments</option>
        <option <?php if ($ordercoms == 3) {
    echo "selected";
}?> value='3'>Oldest Comments</option>
    </select>

    </td>
</tr>

<tr>
    <td>Color Scheme</td>
    <td>
    <select name="colorscheme">
    <?php
if (isset($allData[4])) {
    $colorscheme = $allData[4];

} else {
    $colorscheme = 1;
}
?>
        <option <?php if ($colorscheme == 1) {
    echo "selected";
}?>  value='1'>Light</option>
        <option <?php if ($colorscheme == 2) {
    echo "selected";
}?>  value='2'>Dark</option>
    </select>

    </td>
</tr>

<tr>

    <td colspan="2"><input name="sub" type="submit" value="Save Settings"></td>
</tr>


</table>

</form>


<!--
    <tr><td colspan="2"><h2>Comment Moderation Settings</h2></td><td>
<tr>
<td>
</td>
<td>
</td>
</tr>
    -->
