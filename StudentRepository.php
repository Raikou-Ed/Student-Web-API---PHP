<?php
class StudentRepository {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllStudents() {
        $sql = "SELECT stud_id, stud_name, stud_midterm, stud_final, stud_grade, stud_status FROM student";
        $result = $this->conn->query($sql);

        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
        return $students;
    }

    public function getStudentById($studId) {
        $stmt = $this->conn->prepare("SELECT stud_id, stud_name, stud_midterm, stud_final, stud_grade, stud_status FROM student WHERE stud_id = ?");
        $stmt->bind_param("i", $studId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function addStudent($studName, $studMidterm, $studFinal) {
        $stmt = $this->conn->prepare("INSERT INTO student (stud_name, stud_midterm, stud_final) VALUES (?, ?, ?)");
        $stmt->bind_param("sdd", $studName, $studMidterm, $studFinal);
        return $stmt->execute();
    }

    public function updateStudent($studId, $studMidterm, $studFinal) {
        $stmt = $this->conn->prepare("UPDATE student SET stud_midterm = ?, stud_final = ? WHERE stud_id = ?");
        $stmt->bind_param("ddi", $studMidterm, $studFinal, $studId);
        return $stmt->execute();
    }

    public function deleteStudent($studId) {
        $stmt = $this->conn->prepare("DELETE FROM student WHERE stud_id = ?");
        $stmt->bind_param("i", $studId);
        return $stmt->execute();
    }
}
?>
