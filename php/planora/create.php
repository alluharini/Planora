<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config.php';
include_once 'event.php';

$event = new Event($pdo);

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->event_name) &&
    !empty($data->event_date) &&
    !empty($data->number_of_guests)
) {
    $event->event_name = $data->event_name;
    $event->event_date = $data->event_date;
    $event->number_of_guests = $data->number_of_guests;
    $event->dietary_preferences = $data->dietary_preferences ?? [];
    $event->type_of_event = $data->type_of_event ?? "";
    $event->cuisines = $data->cuisines ?? [];
    $event->expensive_level = $data->expensive_level ?? "";

    if($event->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Event was created successfully."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create event."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create event. Data is incomplete."));
}
?>