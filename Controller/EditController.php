<?php
include $_SERVER['DOCUMENT_ROOT'] . "/Form/Database/database.php";
include $_SERVER['DOCUMENT_ROOT'] . "/Form/Model/FormModel.php";

class EditController {
    private $model;

    public function __construct($conn) {
        $this->model = new FormModel($conn);
    }

    public function handleRequest() {
        if (!isset($_GET['id'])) {
            header("Location: /Form/View/index.php");
            exit();
        }

        $id = intval($_GET['id']);
        $this->edit($id);
    }

    public function edit($id) {
        $formData = $this->model->getFormData($id);

        if (!$formData) {
            header("Location: /Form/View/index.php");
            exit();
        }

        session_start();
        $_SESSION['form_data'] = $formData;
        header("Location: /Form/View/edit.php?id=$id");
        exit();
    }
}

$controller = new EditController($conn);
$controller->handleRequest();
?>