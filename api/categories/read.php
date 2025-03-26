<?php


// Category query
$result = $category->read();

// Get row count
$num = $result->rowCount();

if (isset($_GET['id'])){
    require_once 'read_single.php'; 
} 
else{
    if ($num > 0) {
        $categories_arr = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $categories_arr[] = array('id' => $id, 'category' => $category);
        }

        echo json_encode($categories_arr);
        } else {
            echo json_encode(array('message' => 'category_id Not Found'));
        }
}
?>



