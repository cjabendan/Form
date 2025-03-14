<?php

class FormValidator {
    public function validateNumbersOnly($input) {
        if (empty($input)) {
            return "*Field is required.";
        }
        return preg_match('/^\d+$/', $input) ? null : "*Must contain only numbers.";
    }

    public function validateMustNotContainNumbers($input) {
        if (empty($input)) {
            return "*Field is required.";
        }
        return preg_match('/\d/', $input) ? "*Must not contain numbers." : null;
    }

    public function validateDob($dob) {
        if (empty($dob)) {
            return "*Field is required.";
        } elseif ($this->calculateAge($dob) < 18) {
            return "*Must be at least 18 yrs old.";
        }
        return null;
    }

    public function validateCivilStatus($civilStatus, $otherCivil) {
        if (empty($civilStatus)) {
            return "*Field is required.";
        } elseif ($civilStatus === 'Other' && empty($otherCivil)) {
            return "*Please specify your civil status.";
        }
        return null;
    }

    public function validateEmail($email) {
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