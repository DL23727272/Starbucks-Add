<?php
include "myConnection.php";

$countsQuery = "SELECT 
                    SUM(CASE WHEN status = 'Pending' THEN 1 ELSE 0 END) AS pendingCount,
                    SUM(CASE WHEN status = 'Processing' THEN 1 ELSE 0 END) AS processingCount,
                    SUM(CASE WHEN status = 'Completed' THEN 1 ELSE 0 END) AS completedCount,
                    SUM(CASE WHEN status = 'Cancelled' THEN 1 ELSE 0 END) AS cancelledCount
                FROM order_table";

$result = mysqli_query($con, $countsQuery);
$row = mysqli_fetch_assoc($result);

// Convert the counts to JSON format
echo json_encode($row);
?>
