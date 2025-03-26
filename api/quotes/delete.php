<?php


$quote = new Quote($db);
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id)) {
    $quote->id = intval($data->id);

    // Check if the quote exists before deleting
    if (!$quote->exists()) {
        echo json_encode(['message' => 'No Quotes Found']);
    } elseif ($quote->delete()) {
        echo json_encode([
            'id' => $quote->id
        ]);
    } else {
        echo json_encode(['message' => 'Quote Not Deleted']);
    }
} else {
    echo json_encode(['message' => 'Invalid ID']);
}
?>
