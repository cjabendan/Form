<?php
session_start();

include __DIR__ . "/Database/database.php";
include __DIR__ . "/Model/TableModel.php";

class ViewControl {
    private $model;

    public function __construct($conn) {
        $this->model = new TableModel($conn);
    }

    public function handleRequest() {
        if (!isset($_GET['id'])) {
            header("Location: index.php"); // keep relative paths for portability
            exit();
        }

        $id = intval($_GET['id']);
        $this->show($id);
    }

    public function show($id) {
        $formData = $this->model->getFormData($id);
        if (!$formData) {
            header("Location: index.php");
            exit();
        }

        $dob = new DateTime($formData['dob']);
        $today = new DateTime();
        $age = $today->diff($dob)->y;

        $pageTitle = "Form Data";

        $_SESSION['formData'] = $formData;
        $_SESSION['age'] = $age;
        $_SESSION['pageTitle'] = $pageTitle;

        header("Location: View/view.php");
        exit();
    }
}

$controller = new ViewControl($conn);
$controller->handleRequest();
?>
