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

    if ($quote->create()) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $quotes_arr[] = [
                'id' => $row['id'],
                'quote' => $row['quote'],
                'author_id' => $row['author_id'],
                'category_id' => $row['category_id']
            ];
        }

        echo json_encode($quotes_arr);
    } else {
        echo json_encode(['message' => 'Quote Not Created']);
    }
} else {
    echo json_encode(['message' => 'Incomplete Data']);
}
?>