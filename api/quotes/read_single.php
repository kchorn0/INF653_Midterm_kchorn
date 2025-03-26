<?php


// Get ID from URL
$quote->id = isset($_GET['id']) ? intval($_GET['id']) : die(json_encode(array('message' => 'Quote ID not provided.')));

// Fetch quote
$quote->read_single();

if ($quote->quote) {
    $quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author' => $quote->author,
        'category' => $quote->category
    );

    echo json_encode($quote_arr);
} else {
    echo json_encode(array('message' => 'No Quotes Found'));
}
?>
