<?php

    class FormSessionData {
        
        public $lastName; public $firstName; public $middleInitial; public $dob; public $sex; public $civilStatus;
        public $otherCivil; public $taxIdNumber; public $nationality; public $religion; public $RFUB; public $HLB;
        public $street; public $subdivision; public $BDL; public $CM; public $province; public $country;
        public $zipcode; public $RFUB2; public $HLB2; public $street2; public $subdivision2; public $BDL2;
        public $CM2; public $province2; public $zipcode2; public $country2; public $mobileNumber; public $email;
        public $telephoneNumber; public $fatherLastName; public $fatherFirstName; public $fatherMiddleName;
        public $motherLastName; public $motherFirstName; public $motherMiddleName;
        
        public function __construct($data = []) {
            $this->lastName = $data['ln'] ?? '';
            $this->firstName = $data['fn'] ?? '';
            $this->middleInitial = $data['mn'] ?? '';
            $this->dob = $data['dob'] ?? '';
            $this->sex = $data['sex'] ?? '';
            $this->civilStatus = $data['cv'] ?? '';
            $this->otherCivil = $data['ocv'] ?? '';
            $this->taxIdNumber = $data['tin'] ?? '';
            $this->nationality = $data['nat'] ?? '';
            $this->religion = $data['reg'] ?? '';
            $this->RFUB = $data['rfub'] ?? '';
            $this->HLB = $data['hlb'] ?? '';
            $this->street = $data['strt'] ?? '';
            $this->subdivision = $data['sub'] ?? '';
            $this->BDL = $data['bdl'] ?? '';
            $this->CM = $data['cm'] ?? '';
            $this->province = $data['prov'] ?? '';
            $this->country = $data['ctry'] ?? '';
            $this->zipcode = $data['zip'] ?? '';
            $this->mobileNumber = $data['num'] ?? '';
            $this->email = $data['mail'] ?? '';
            $this->telephoneNumber = $data['tele'] ?? '';
            $this->fatherLastName = $data['fln'] ?? '';
            $this->fatherFirstName = $data['ffn'] ?? '';
            $this->fatherMiddleName = $data['fmn'] ?? '';
            $this->motherLastName = $data['mln'] ?? '';
            $this->motherFirstName = $data['mfn'] ?? '';
            $this->motherMiddleName = $data['mmn'] ?? '';
            $this->RFUB2 = $data['rfub2'] ?? '';
            $this->HLB2 = $data['hlb2'] ?? '';
            $this->street2 = $data['strt2'] ?? '';
            $this->subdivision2 = $data['sub2'] ?? '';
            $this->BDL2 = $data['bdl2'] ?? '';
            $this->CM2 = $data['cm2'] ?? '';
            $this->province2 = $data['prov2'] ?? '';
            $this->country2 = $data['ctry2'] ?? '';
            $this->zipcode2 = $data['zip2'] ?? '';
        }
    }

?>