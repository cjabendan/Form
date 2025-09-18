<?php
  include_once __DIR__ . "/../Database/database.php";

    class TableModel {
        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }

        public function tableForms() {
            $sql = "SELECT id, fn, ln, mn, dob, sex FROM formsdata ORDER BY id DESC";
            $result = $this->conn->query($sql);

            if ($result === false) {
                die("Error executing query: " . $this->conn->error);
            }

            return $result;
        }


        public function getFormData($id) {
            $sql = "SELECT * FROM formsdata WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return null;
            }
        }

        public function delForm($id) {
            $sql = "DELETE FROM formsdata WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
        
            if ($stmt) {
                $stmt->bind_param("i", $id);
                return $stmt->execute();

            }
            return false;
        }

    }
?>