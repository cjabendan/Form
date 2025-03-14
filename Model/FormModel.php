<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/Form/Database/database.php"; 
    require 'Session.php';

    class FormModel {
        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }

        public function insertData($data) {
            $sql = "INSERT INTO formsdata (
                        fn, ln, mn, dob, sex, cv, ocv, tin, nat, reg, rfub, hlb, strt, sub, bdl, cm, prov, zip, ctry,
                        rfub2, hlb2, strt2, sub2, bdl2, cm2, prov2, zip2, ctry2, num, mail, tele, fln, ffn, fmn, mln, mfn, mmn
                    ) VALUES (
                        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
                        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
                    )";
        
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->conn->error);
            }
            
            $stmt->bind_param(
                "sssssssssssssssssssssssssssssssssssss", 
                $data['fn'], $data['ln'], $data['mn'], $data['dob'], $data['sex'], $data['cv'], $data['ocv'], $data['tin'], 
                $data['nat'], $data['reg'], $data['rfub'], $data['hlb'], $data['strt'], $data['sub'], $data['bdl'], $data['cm'], 
                $data['prov'], $data['zip'], $data['ctry'], $data['rfub2'], $data['hlb2'], $data['strt2'], $data['sub2'], 
                $data['bdl2'], $data['cm2'], $data['prov2'], $data['zip2'], $data['ctry2'], $data['num'], $data['mail'], 
                $data['tele'], $data['fln'], $data['ffn'], $data['fmn'], $data['mln'], $data['mfn'], $data['mmn']
            );
            
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error inserting record: " . $stmt->error);
            }
        
            $stmt->close();
        }

        public function updateData($id, $data) {
            $sql = "UPDATE formsdata SET 
                        fn = ?, ln = ?, mn = ?, dob = ?, sex = ?, cv = ?, ocv = ?, tin = ?, nat = ?, reg = ?, rfub = ?, hlb = ?, strt = ?, sub = ?, bdl = ?, cm = ?, prov = ?, zip = ?, ctry = ?,
                        rfub2 = ?, hlb2 = ?, strt2 = ?, sub2 = ?, bdl2 = ?, cm2 = ?, prov2 = ?, zip2 = ?, ctry2 = ?, num = ?, mail = ?, tele = ?,
                        fln = ?, ffn = ?, fmn = ?, mln = ?, mfn = ?, mmn = ? 
                    WHERE id = ?";
        
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->conn->error);
            }

            $stmt->bind_param(
                "sssssssssssssssssssssssssssssssssssssi", 
                $data['fn'], $data['ln'], $data['mn'], $data['dob'], $data['sex'], $data['cv'], $data['ocv'], $data['tin'], 
                $data['nat'], $data['reg'], $data['rfub'], $data['hlb'], $data['strt'], $data['sub'], $data['bdl'], $data['cm'], 
                $data['prov'], $data['zip'], $data['ctry'], $data['rfub2'], $data['hlb2'], $data['strt2'], $data['sub2'], 
                $data['bdl2'], $data['cm2'], $data['prov2'], $data['zip2'], $data['ctry2'], $data['num'], $data['mail'], 
                $data['tele'], $data['fln'], $data['ffn'], $data['fmn'], $data['mln'], $data['mfn'], $data['mmn'], $id
            );
            
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error updating record: " . $stmt->error);
            }
            $stmt->close();
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
    }
?>