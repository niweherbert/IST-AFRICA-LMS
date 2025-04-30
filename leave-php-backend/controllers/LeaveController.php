
<?php
require_once __DIR__ . '/../models/Leave.php';
require_once __DIR__ . '/../config/db.php';

$leave = new Leave($pdo);
$action = $_GET['action'] ?? '';

switch ($action) {
    case 'apply':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($leave->applyLeave($data['user_id'], $data['type'], $data['start'], $data['end'], $data['reason'] ?? null));
        break;
    case 'balance':
        $userId = $_GET['user_id'];
        echo json_encode($leave->getLeaveBalance($userId));
        break;
    case 'history':
        $userId = $_GET['user_id'];
        echo json_encode($leave->getLeaveHistory($userId));
        break;
    default:
        http_response_code(400);
        echo json_encode(["error" => "Invalid action"]);
}
?>
