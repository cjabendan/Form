<?php
require_once __DIR__ . "/Model/FormModel.php"; 
require_once __DIR__ . "/Class/CivilStatus.php";
require_once __DIR__ . "/Class/Countries.php";

class FormController {
    private $model;

    public function __construct($conn) {
        $this->model = new FormModel($conn);
    }

    public function handleRequest() {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            unset($_SESSION['form_data']);
            unset($_SESSION['form_errors']);
        } 

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $civilStatus = new CivilStatus();
        $civilOpt = $civilStatus->getOptions();
    
        $countries = new Countries();
        $countryOpt = $countries->getOptions();
        $countryOpt2 = $countries->getOptions();

        $errors = [];
        $success = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $lastName = trim($_POST['ln'] ?? '');
            $firstName = trim($_POST['fn'] ?? '');
            $middleInitial = trim($_POST['mn'] ?? '');
            $dob = $_POST['dob'];
            $sex = $_POST['sex'] ?? '';
            $civilStatus = $_POST['civil'] ?? '';
            $otherCivil = trim($_POST['other_civil_stats'] ?? '');
            if ($civilStatus === 'Other' && !empty($otherCivil)) {
                $civilStatus = "Other";
            }
            $taxIdNumber = trim($_POST['tin'] ?? '');
            $nationality = trim($_POST['nat'] ?? '');
            $religion = trim($_POST['reg'] ?? '');
            $RFUB = trim($_POST['rfub'] ?? '');
            $HLB = trim($_POST['hlb'] ?? '');
            $street = trim($_POST['street'] ?? '');
            $subdivision = trim($_POST['sub'] ?? '');
            $BDL = trim($_POST['bdl'] ?? '');
            $CM = trim($_POST['cm'] ?? '');
            $province = trim($_POST['prov'] ?? '');
            $zipcode = trim($_POST['zip'] ?? '');
            $country = $_POST['country'] ?? '';
            $RFUB2 = trim($_POST['rfub2'] ?? '');
            $HLB2 = trim($_POST['hlb2'] ?? '');
            $street2 = trim($_POST['street2'] ?? '');
            $subdivision2 = trim($_POST['sub2'] ?? '');
            $BDL2 = trim($_POST['bdl2'] ?? '');
            $CM2 = trim($_POST['cm2'] ?? '');
            $province2 = trim($_POST['prov2'] ?? '');
            $zipcode2 = trim($_POST['zip2'] ?? '');
            $country2 = $_POST['country2'] ?? '';
            $mobileNumber = trim($_POST['mnum'] ?? '');
            $email = trim($_POST['mail'] ?? '');
            $telephoneNumber = trim($_POST['tele'] ?? '');
            $fatherLastName = trim($_POST['f_ln'] ?? '');
            $fatherFirstName = trim($_POST['f_fn'] ?? '');
            $fatherMiddleName = trim($_POST['f_mn'] ?? '');
            $motherLastName = trim($_POST['m_ln'] ?? '');
            $motherFirstName = trim($_POST['m_fn'] ?? '');
            $motherMiddleName = trim($_POST['m_mn'] ?? '');

            // Validate inputs
            $errors['ln'] = $this->validateMustNotContainNumbers($lastName);
            $errors['fn'] = $this->validateMustNotContainNumbers($firstName);
            $errors['mn'] = $this->validateMustNotContainNumbers($middleInitial);
            $errors['dob'] = $this->validateDob($dob);
            $errors['sex'] = empty($sex) ? "*Field is required." : null;
            $errors['civil'] = $this->validateCivilStatus($civilStatus, $otherCivil);
            $errors['tin'] = !empty($taxIdNumber) ? $this->validateNumbersOnly($taxIdNumber) : null; 
            $errors['nat'] = empty($nationality) ? "*Field is required." : null;
            $errors['rfub'] = empty($RFUB) ? "*Field is required." : null;
            $errors['hlb'] = empty($HLB) ? "*Field is required." : null;
            $errors['street'] = empty($street) ? "*Field is required." : null;
            $errors['sub'] = empty($subdivision) ? "*Field is required." : null;
            $errors['bdl'] = empty($BDL) ? "*Field is required." : null;
            $errors['cm'] = empty($CM) ? "*Field is required." : null;
            $errors['prov'] = empty($province) ? "*Field is required." : null;
            $errors['zip'] = $this->validateNumbersOnly($zipcode);
            $errors['country'] = empty($country) ? "*Field is required." : null;
            $errors['rfub2'] = empty($RFUB2) ? "*Field is required." : null;
            $errors['hlb2'] = empty($HLB2) ? "*Field is required." : null;
            $errors['street2'] = empty($street2) ? "*Field is required." : null;
            $errors['sub2'] = empty($subdivision2) ? "*Field is required." : null;
            $errors['bdl2'] = empty($BDL2) ? "*Field is required." : null;
            $errors['cm2'] = empty($CM2) ? "*Field is required." : null;
            $errors['prov2'] = empty($province2) ? "*Field is required." : null;
            $errors['zip2'] = $this->validateNumbersOnly($zipcode2);
            $errors['country2'] = empty($country2) ? "*Field is required." : null;
            $errors['mnum'] = $this->validateNumbersOnly($mobileNumber);
            $errors['mail'] = $this->validateEmail($email); 
            $errors['tele'] = !empty($telephoneNumber) ? $this->validateNumbersOnly($telephoneNumber) : null;
            $errors['f_ln'] = !empty($fatherLastName) ? $this->validateMustNotContainNumbers($fatherLastName) : null;
            $errors['f_fn'] = !empty($fatherFirstName) ? $this->validateMustNotContainNumbers($fatherFirstName) : null;
            $errors['f_mn'] = !empty($fatherMiddleName) ? $this->validateMustNotContainNumbers($fatherMiddleName) : null;
            $errors['m_ln'] = !empty($motherLastName) ? $this->validateMustNotContainNumbers($motherLastName) : null;
            $errors['m_fn'] = !empty($motherFirstName) ? $this->validateMustNotContainNumbers($motherFirstName) : null;
            $errors['m_mn'] = !empty($motherMiddleName) ? $this->validateMustNotContainNumbers($motherMiddleName) : null;

            if (!empty(array_filter($errors))) {
                $_SESSION['form_data'] = [
                    'ln' => $lastName, 'fn' => $firstName, 'mn' => $middleInitial,
                    'dob' => $dob, 'sex' => $sex, 'cv' => $civilStatus, 'ocv' => $otherCivil,
                    'tin' => $taxIdNumber, 'nat' => $nationality, 'reg' => $religion,
                    'rfub' => $RFUB, 'hlb' => $HLB, 'strt' => $street,
                    'sub' => $subdivision, 'bdl' => $BDL, 'cm' => $CM, 'prov' => $province,
                    'zip' => $zipcode, 'ctry' => $country, 'rfub2' => $RFUB2, 'hlb2' => $HLB2,
                    'strt2' => $street2, 'sub2' => $subdivision2, 'bdl2' => $BDL2,
                    'cm2' => $CM2, 'prov2' => $province2, 'zip2' => $zipcode2,
                    'ctry2' => $country2, 'num' => $mobileNumber, 'mail' => $email,
                    'tele' => $telephoneNumber, 'fln' => $fatherLastName, 'ffn' => $fatherFirstName,
                    'fmn' => $fatherMiddleName, 'mln' => $motherLastName, 'mfn' => $motherFirstName,
                    'mmn' => $motherMiddleName
                ];
                $_SESSION['form_errors'] = $errors;
            } else {
                if (isset($_POST['id'])) {
                    $id = intval($_POST['id']);
                    $success = $this->model->updateData($id, [
                        'ln' => $lastName, 'fn' => $firstName, 'mn' => $middleInitial,
                        'dob' => $dob, 'sex' => $sex, 'cv' => $civilStatus, 'ocv' => $otherCivil,
                        'tin' => $taxIdNumber, 'nat' => $nationality, 'reg' => $religion,
                        'rfub' => $RFUB, 'hlb' => $HLB, 'strt' => $street,
                        'sub' => $subdivision, 'bdl' => $BDL, 'cm' => $CM, 'prov' => $province,
                        'zip' => $zipcode, 'ctry' => $country, 'rfub2' => $RFUB2, 'hlb2' => $HLB2,
                        'strt2' => $street2, 'sub2' => $subdivision2, 'bdl2' => $BDL2,
                        'cm2' => $CM2, 'prov2' => $province2, 'zip2' => $zipcode2,
                        'ctry2' => $country2, 'num' => $mobileNumber, 'mail' => $email,
                        'tele' => $telephoneNumber, 'fln' => $fatherLastName, 'ffn' => $fatherFirstName,
                        'fmn' => $fatherMiddleName, 'mln' => $motherLastName, 'mfn' => $motherFirstName,
                        'mmn' => $motherMiddleName
                    ]);
                }else{
                    $success = $this->model->insertData([
                        'ln' => $lastName, 'fn' => $firstName, 'mn' => $middleInitial,
                        'dob' => $dob, 'sex' => $sex, 'cv' => $civilStatus, 'ocv' => $otherCivil,
                        'tin' => $taxIdNumber, 'nat' => $nationality, 'reg' => $religion,
                        'rfub' => $RFUB, 'hlb' => $HLB, 'strt' => $street,
                        'sub' => $subdivision, 'bdl' => $BDL, 'cm' => $CM, 'prov' => $province,
                        'zip' => $zipcode, 'ctry' => $country, 'rfub2' => $RFUB2, 'hlb2' => $HLB2,
                        'strt2' => $street2, 'sub2' => $subdivision2, 'bdl2' => $BDL2,
                        'cm2' => $CM2, 'prov2' => $province2, 'zip2' => $zipcode2,
                        'ctry2' => $country2, 'num' => $mobileNumber, 'mail' => $email,
                        'tele' => $telephoneNumber, 'fln' => $fatherLastName, 'ffn' => $fatherFirstName,
                        'fmn' => $fatherMiddleName, 'mln' => $motherLastName, 'mfn' => $motherFirstName,
                        'mmn' => $motherMiddleName
                    ]);
                }

                if ($success) {
                    unset($_SESSION['form_data']);
                    unset($_SESSION['form_errors']);
                    header("Location: /Form/View/view.php");
                    exit();
                }
            }
        }
    }

    private function validateNumbersOnly($input) {
        if (empty($input)) {
            return "*Field is required.";
        }
        return preg_match('/^[\+0-9\s\(\)-]+$/', $input) ? null : "*Must contain only numbers.";
    }

    private function validateMustNotContainNumbers($input) {
        if (empty($input)) {
            return "*Field is required.";
        }
        return preg_match('/\d/', $input) ? "*Must not contain numbers." : null;
    }

    private function validateDob($dob) {
        if (empty($dob)) {
            return "*Field is required.";
        } elseif ($this->calculateAge($dob) < 18) {
            return "*Must be at least 18 yrs old.";
        }
        return null;
    }

    private function validateCivilStatus($civilStatus, $otherCivil) {
        if (empty($civilStatus)) {
            return "*Field is required.";
        } elseif ($civilStatus === 'Other' && empty($otherCivil)) {
            return "*Please specify your civil status.";
        }
        return null;
    }

    private function validateEmail($email) {
        if (empty($email)) {
            return "";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "*Invalid email format.";
        }
        return null;
    }

    private function calculateAge($dob) {
        $birthDate = new DateTime($dob);
        $today = new DateTime('today');
        return $birthDate->diff($today)->y;
    }
}
?>