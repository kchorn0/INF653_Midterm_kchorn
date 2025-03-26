<?php


// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Ensure required data is present
if (!empty($data->id)) {
    $category->id = intval($data->id);

    // Check if the category exists before deleting
    if (!$category->exists()) {
        echo json_encode(['message' => 'Category ID Not Found']);
    } elseif ($category->delete()) {
        echo json_encode([
            'id' => $category->id
        ]);
    } else {
        echo json_encode(['message' => 'Category Not Deleted']);
    }
} else {
    echo json_encode(['message' => 'Category ID is required.']);
}
?>
