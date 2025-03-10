<?php
require_once '../Repositories/StudentRepository.php';
require_once '../Core/Response.php';

class StudentController {
    private $repositories;

    public function __construct($db) {
        $this->repositories = new StudentRepository($db);
    }

    public function getAllStudents() {
        $studentRepository = $this->repositories->getAllStudents();
        Response::json($studentRepository);
    }

    public function getStudentById($studId) {
        $studentRepository = $this->repositories->getStudentById($studId);
        if ($studentRepository) {
            Response::json($studentRepository);
        } else {
            Response::json(["message" => "Student not found."], 404);
        }
    }

    public function addStudent($data) {
        if (isset($data['studName'], $data['studMidterm'], $data['studFinal'])) {
            $this->repositories->addStudent($data['studName'], $data['studMidterm'], $data['studFinal']);
            Response::json(["message" => "Student added successfully."]);
        } else {
            Response::json(["message" => "Invalid input."], 400);
        }
    }

    public function updateStudent($data) {
        if (isset($data['studId'], $data['studMidterm'], $data['studFinal'])) {
            $this->repositories->updateStudent($data['studId'], $data['studMidterm'], $data['studFinal']);
            Response::json(["message" => "Student updated successfully."]);
        } else {
            Response::json(["message" => "Invalid input."], 400);
        }
    }

    public function deleteStudent($studId) {
        $this->repositories->deleteStudent($studId);
        Response::json(["message" => "Student deleted successfully."]);
    }
}
?>
