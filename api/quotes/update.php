<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate quote object
$quote = new Quote($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Debugging: Show received data
echo json_encode(["received_data" => $data]);

// Ensure required data is present
if (!empty($data->id) && !empty($data->quote) && !empty($data->author_id) && !empty($data->category_id)) {
    // Assign data to the quote object
    $quote->id = intval($data->id);
    $quote->quote = htmlspecialchars(strip_tags($data->quote));
    $quote->author_id = intval($data->author_id);
    $quote->category_id = intval($data->category_id);

    // Debugging: Confirm function call
    echo json_encode(["message" => "Attempting to update record..."]);

    // Update quote

    if ($quote->exists()) {
            // Update quote
            if ($quote->update()) {
                echo json_encode(array('message' => "Quote updated successfully."));
            } else {
                echo json_encode(array('message' => 'Failed to update category.'));
            }
        } else {
            echo json_encode(array('message' => 'category_id Not Found.'));
        }
} else {
    echo json_encode(["message" => "Quote ID, text, author ID, and category ID are required."]);
}
?>
