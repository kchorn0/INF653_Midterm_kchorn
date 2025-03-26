<?php


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
    echo json_encode(['message' => 'Missing Required Parameters']);
}
?>
