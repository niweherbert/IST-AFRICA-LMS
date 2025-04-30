
<?php
require_once __DIR__ . '/../config/db.php';

class Leave {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function applyLeave($userId, $type, $start, $end, $reason = null) {
        $stmt = $this->pdo->prepare("INSERT INTO leave_requests (user_id, type, start_date, end_date, reason) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$userId, $type, $start, $end, $reason]);
    }

    public function getLeaveBalance($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM leave_balances WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getLeaveHistory($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM leave_requests WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
