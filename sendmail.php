<?php
include_once 'config.php';
?>

<?php
$sql= "SELECT id,revisionDate,approverEmail FROM riskassessment where approverEmail != ''";
    $result = mysqli_query($con, $sql);
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["id"]. " - RevisionDate: " . $row["revisionDate"]. " " . $row["approverEmail"]. "<br>";
		$today = date($row["revisionDate"]);
$day_before = date( 'Y-m-d', strtotime( $today . ' -1 day' ) );

        $to = ($row["approverEmail"]);
        $subject = "Your account is going to expire please Renew";
        $txt = "Dear RA Member" .$row["id"]. "Your account is going to expire by tommorrow";
        $headers = "From: webmaster@example.com";

         mail($to,$subject,$txt,$headers);


    }
} else {
    echo "0 results";
}
?>





