<?php
include __DIR__ . "/Form/Database/database.php";
include __DIR__ . "/Form/Model/FormModel.php";


class EditController {
    private $model;

    public function __construct($conn) {
        $this->model = new FormModel($conn);
    }

    public function handleRequest() {
        if (!isset($_GET['id'])) {
            header("Location: index.php");
            exit();
        }

        $id = intval($_GET['id']);
        $this->edit($id);
    }

    public function edit($id) {
        $formData = $this->model->getFormData($id);

        if (!$formData) {
            header("Location: index.php");
            exit();
        }

        session_start();
        $_SESSION['form_data'] = $formData;
        header("Location: View/edit.php?id=$id");
        exit();
    }
}

$controller = new EditController($conn);
$controller->handleRequest();
?>