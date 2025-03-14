<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT'] . "/Form/Database/database.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/Form/Model/TableModel.php";

    class ViewControl {
        private $model;

        public function __construct($conn) {
            $this->model = new TableModel($conn);
        }

        public function handleRequest() {
            if (!isset($_GET['id'])) {
                header("Location: /Form/View/index.php");
                exit();
            }

            $id = intval($_GET['id']);
            $this->show($id);
        }

        public function show($id) {
            $formData = $this->model->getFormData($id);
            if (!$formData) {
                header("Location: /Form/View/index.php");
                exit();
            }

            
            $dob = new DateTime($formData['dob']);
            $today = new DateTime();
            $age = $today->diff($dob)->y;

            $pageTitle = "Form Data";

            $_SESSION['formData'] = $formData;
            $_SESSION['age'] = $age;
            $_SESSION['pageTitle'] = $pageTitle;

            header("Location: /Form/View/view.php");
            exit();
        }
    }

    $controller = new ViewControl($conn);
    $controller->handleRequest();
?>