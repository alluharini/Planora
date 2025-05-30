<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Content-Type: application/json");

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "planora";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode([
        "status" => false,
        "message" => "Database connection failed",
        "data" => []
    ]);
    exit();
}

// Class definition
class Event {
    private $conn;
    private $table_name = "events";

    public $event_name;
    public $event_date;
    public $number_of_guests;
    public $dietary_preferences;
    public $type_of_event;
    public $cuisines;
    public $expensive_level;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO {$this->table_name}
            (event_name, event_date, number_of_guests, dietary_preferences, type_of_event, cuisines, expensive_level, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        // Sanitize and encode
        $this->event_name = htmlspecialchars(strip_tags($this->event_name));
        $this->event_date = htmlspecialchars(strip_tags($this->event_date));
        $this->number_of_guests = intval($this->number_of_guests);
        $this->dietary_preferences = json_encode($this->dietary_preferences);
        $this->type_of_event = htmlspecialchars(strip_tags($this->type_of_event));
        $this->cuisines = json_encode($this->cuisines);
        $this->expensive_level = htmlspecialchars(strip_tags($this->expensive_level));
        $this->created_at = date('Y-m-d H:i:s');

        $stmt->bind_param(
            "ssisssss",
            $this->event_name,
            $this->event_date,
            $this->number_of_guests,
            $this->dietary_preferences,
            $this->type_of_event,
            $this->cuisines,
            $this->expensive_level,
            $this->created_at
        );

        if ($stmt->execute()) {
            $last_id = $this->conn->insert_id;
            return [
                "status" => true,
                "message" => "Event created successfully",
                "data" => [[
                    "id" => $last_id,
                    "event_name" => $this->event_name,
                    "event_date" => $this->event_date,
                    "number_of_guests" => $this->number_of_guests,
                    "dietary_preferences" => json_decode($this->dietary_preferences),
                    "type_of_event" => $this->type_of_event,
                    "cuisines" => json_decode($this->cuisines),
                    "expensive_level" => $this->expensive_level,
                    "created_at" => $this->created_at
                ]]
            ];
        } else {
            return [
                "status" => false,
                "message" => "Failed to create event",
                "data" => []
            ];
        }
    }
}

// Handle form-data input
$event = new Event($conn);

// Use $_POST for form-data
$event->event_name = $_POST['event_name'] ?? '';
$event->event_date = $_POST['event_date'] ?? '';
$event->number_of_guests = $_POST['number_of_guests'] ?? 0;
$event->dietary_preferences = isset($_POST['dietary_preferences']) ? json_decode($_POST['dietary_preferences'], true) : [];
$event->type_of_event = $_POST['type_of_event'] ?? '';
$event->cuisines = isset($_POST['cuisines']) ? json_decode($_POST['cuisines'], true) : [];
$event->expensive_level = $_POST['expensive_level'] ?? '';

if (empty($event->event_name) || empty($event->event_date)) {
    echo json_encode([
        "status" => false,
        "message" => "Event name and date are required",
        "data" => []
    ]);
    exit();
}

// Run and return result
$result = $event->create();
echo json_encode($result);
?>
