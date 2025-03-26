<?php

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Ensure required data is present
if (isset($data->id) && isset($data->category) && !empty($data->id) && !empty($data->category)) {
    $category->id = intval($data->id);
    $category->category = htmlspecialchars(strip_tags($data->category));

    // Check if category exists before updating
    if ($category->exists()) {
        // Update category
        if ($category->update()) {
            echo json_encode(array(
                'id' => $category->id,
                'category' => $category->category
            ));
        } else {
            echo json_encode(array('message' => 'Failed to update category.'));
        }
    } else {
        echo json_encode(array('message' => 'Category ID Not Found.'));
    }
} else {
    echo json_encode(array('message' => 'Missing Required Parameters'));
}
?>
