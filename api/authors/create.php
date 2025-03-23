<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate author object
$author = new Author($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->author)) {
    $author->author = htmlspecialchars(strip_tags($data->author));

    // Create author
    if ($author->create()) {
        echo json_encode([
            'id' => $author->id, // Return the last inserted ID
            'author' => $author->author
        ]);
    } else {
        echo json_encode(['message' => 'Author not created.']);
    }
} else {
    echo json_encode(['message' => 'Author name is required.']);
}
?>
