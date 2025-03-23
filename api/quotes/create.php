<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);

// Get posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required parameters are provided and not empty
if (isset($data->quote) && !empty($data->quote) &&
    isset($data->author_id) && !empty($data->author_id) &&
    isset($data->category_id) && !empty($data->category_id)) {

    // Assign variables
    $newQuote->quote = htmlspecialchars(strip_tags($data->quote));
    $newQuote->author_id = intval($data->author_id);
    $newQuote->category_id = intval($data->category_id);

    // Function to check if ID exists in a given table
    function isValid($id, $model) {
        return $model->exists($id);
    }

    // Check if authorId exists in the database
    if (!isValid($newQuote->author_id, $newAuthor)) {
        echo json_encode(['message' => 'author_id Not Found']);
    }
    // Check if categoryId exists in the database
    else if (!isValid($newQuote->category_id, $newCategory)) {
        echo json_encode(['message' => 'category_id Not Found']);
    }
    // If both are valid, create the new quote entry
    else {
        $new_quote_id = $newQuote->create2();
        if ($new_quote_id) {
            echo json_encode([
                'id' => $new_quote_id,
                'quote' => $newQuote->quote,
                'author_id' => $newQuote->author_id,
                'category_id' => $newQuote->category_id
            ]);
        } else {
            echo json_encode(['message' => 'quote_id Not Found']);
        }
    }
}
// If required parameters are missing
else {
    echo json_encode(['message' => 'Missing Required Parameters']);
}

exit(); // Prevent processing multiple operations in one request
?>