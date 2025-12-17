<?php
include 'config.php';

$sql = "SELECT * FROM members ORDER BY tanggal_daftar DESC";
$result = $conn->query($sql);

$members = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Check if membership is expired
        $today = date('Y-m-d');
        if ($row['tanggal_expired'] < $today) {
            // Update status to expired
            $update_sql = "UPDATE members SET status = 'expired' WHERE id = " . $row['id'];
            $conn->query($update_sql);
            $row['status'] = 'expired';
        }
        $members[] = $row;
    }
}

$conn->close();
echo json_encode($members);
?>