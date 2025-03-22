<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$category = new Category($db);

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
            echo json_encode(array('message' => 'Category updated.'));
        } else {
            echo json_encode(array('message' => 'Failed to update category.'));
        }
    } else {
        echo json_encode(array('message' => 'category_id Not Found.'));
    }
} else {
    echo json_encode(array('message' => '‘Missing Required Parameters'));
}
?>
