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

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->quote) && !empty($data->author_id) && !empty($data->category_id)) {
    $quote->quote = $data->quote;
    $quote->author_id = intval($data->author_id);
    $quote->category_id = intval($data->category_id);

    // Check if author_id exists
    $author_check_query = "SELECT id FROM authors WHERE id = :author_id";
    $stmt = $db->prepare($author_check_query);
    $stmt->bindParam(':author_id', $quote->author_id);
    $stmt->execute();
    
    if ($stmt->rowCount() == 0) {
        echo json_encode(['message' => 'author_id Not Found']);
        exit();
    }

    // Check if category_id exists
    $category_check_query = "SELECT id FROM categories WHERE id = :category_id";
    $stmt = $db->prepare($category_check_query);
    $stmt->bindParam(':category_id', $quote->category_id);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        echo json_encode(['message' => 'category_id Not Found']);
        exit();
    }

    // Create the quote
    $new_quote_id = $quote->create2();

    if ($new_quote_id) {
        echo json_encode([
            'id' => $new_quote_id,
            'quote' => $quote->quote,
            'author_id' => $quote->author_id,
            'category_id' => $quote->category_id
        ]);
    } else {
        echo json_encode(['message' => 'Quote Not Created']);
    }
} else {
    echo json_encode(['message' => 'Missing Required Parameters']);
}
?>
