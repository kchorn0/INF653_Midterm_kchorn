<?php


// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->category)) {
    $category->category = htmlspecialchars(strip_tags($data->category));

    // Create category
    if ($category->create()) {
        echo json_encode([
            'id' => $category->id, // Return the last inserted ID
            'category' => $category->category
        ]);
    } else {
        echo json_encode(array('message' => 'Category not created.'));
    }
} else {
    echo json_encode(array('message' => 'Missing Required Parameters'));
}
?>
