<?php

// Get ID from URL
$category->id = isset($_GET['id']) ? intval($_GET['id']) : die(json_encode(array('message' => 'catagory_id Not Found.')));

// Fetch category
$category->read_single();

if ($category->category) {
    $category_arr = array(
        'id' => $category->id,
        'category' => $category->category
    );

    echo json_encode($category_arr);
} else {
    echo json_encode(array('message' => 'category_id Not Found'));
}
?>
