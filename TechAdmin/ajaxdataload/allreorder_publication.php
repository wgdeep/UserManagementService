<?php
require_once("../include/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order'])) {
    $order = $_POST['order']; // Array of row IDs in the new order

    foreach ($order as $position => $id) {
        $id = mysqli_real_escape_string($con, $id); // Sanitize input
        $position = $position + 1; // Adjust for zero-based index

        // Update the display_order for each row
        $query = "UPDATE publication SET display_order = $position WHERE id = $id";
        mysqli_query($con, $query);
    }

    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
