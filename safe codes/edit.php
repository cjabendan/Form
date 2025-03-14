<?php   
    include $_SERVER['DOCUMENT_ROOT']."/Form/Database/database.php";

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']); 
        $sql = "SELECT * FROM formsdata WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();$lastName = $row['ln'];$firstName = $row['fn'];
            $middleInitial = $row['mn'];$dob = $row['dob'];$sex = $row['sex'];$civilStatus = $row['cv'];
            $otherCivil = $row['ocv'];$taxIdNumber = $row['tin'];$nationality = $row['nat'];
            $religion = $row['reg'];$RFUB = $row['rfub'];$HLB = $row['hlb'];$street = $row['strt'];
            $subdivision = $row['sub'];$BDL = $row['bdl'];$CM = $row['cm'];$province = $row['prov'];
            $zipcode = $row['zip'];$country = $row['ctry'];$RFUB2 = $row['rfub2'];$HLB2 = $row['hlb2'];
            $street2 = $row['strt2'];$subdivision2 = $row['sub2'];$BDL2 = $row['bdl2'];$CM2 = $row['cm2'];
            $province2 = $row['prov2'];$zipcode2 = $row['zip2'];$country2 = $row['ctry2'];$mobileNumber = $row['num'];
            $email = $row['mail'];$telephoneNumber = $row['tele'];$fatherLastName = $row['fln'];
            $fatherFirstName = $row['ffn'];$fatherMiddleName = $row['fmn'];$motherLastName = $row['mln'];
            $motherFirstName = $row['mfn'];$motherMiddleName = $row['mmn'];
        } else {
            die("Record not found.");
        }
        $stmt->close();
    }

    $civilstats = [
        "Single", "Married", "Widowed", "Legally Separate", "Other"
    ];

    function CivilArr($civilstats, $selected = '') {
        $options = "<option value=''>Select civil status</option>";
            foreach ($civilstats as $cs) {
                $isSelected = ($selected === $cs) ? 'selected' : '';
                $options .= "<option value='$cs' $isSelected>$cs</option>";
            }
            return $options;
        }

    $civilOpt = CivilArr($civilstats, $civilStatus);

    $countries = [
        "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia",
        "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus",
        "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil",
        "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Chile", "China",
        "Colombia", "Comoros", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti",
        "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Estonia", "Eswatini", "Ethiopia", "Fiji", "Finland",
        "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea",
        "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq",
        "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kuwait", "Kyrgyzstan",
        "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Lithuania", "Luxembourg", "Madagascar",
        "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Mauritius", "Mexico", "Moldova", "Monaco", "Mongolia",
        "Morocco", "Mozambique", "Myanmar", "Namibia", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger",
        "Nigeria", "Norway", "Oman", "Pakistan", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines",
        "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Senegal", "Serbia", "Singapore", "Slovakia",
        "Slovenia", "South Africa", "South Korea", "Spain", "Sri Lanka", "Sudan", "Suriname", "Sweden", "Switzerland",
        "Syria", "Taiwan", "Tanzania", "Thailand", "Tunisia", "Turkey", "Uganda", "Ukraine", "United Kingdom",
        "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe"
        ];

    function CountryArr($countries, $selected = '') {
        $options = "<option value=''>Select a country</option>";
            foreach ($countries as $country) {
                $isSelected = ($selected === $country) ? 'selected' : '';
                $options .= "<option value='$country' $isSelected>$country</option>";
            }
            return $options;
        }   

    $countryOpt = CountryArr($countries, $country);
    $countryOpt2 = CountryArr($countries, $country2);
    
    $errors = [];
    $success = false;

    function calculateAge($dob) {
        $birthDate = new DateTime($dob);
        $today = new DateTime('today');
        return $birthDate->diff($today)->y;
        }

    function validateSpaces($input) {
        return trim($input) !== '';
    }
        
    function validateName($name, $fieldName) {
        if (empty($name)) {
            return "*Field is required.";
         } elseif (preg_match('/[0-9]/', $name)) {
             return "*Must not contain numbers.";
          }
            return null;
        }
        
     function validateDob($dob) {
         if (empty($dob)) {
            return "*Field is required.";
          } elseif (calculateAge($dob) < 18) {
             return "*Must be at least 18 yrs old.";
          }
            return null;
        }
        
    function validateCivilStatus($civilStatus, $otherCivil) {
            if (empty($civilStatus)) {
                return "*Field is required.";
            } elseif ($civilStatus === 'Other' && empty($otherCivil)) {
                return "*Please specify your civil status.";
            }
            return null;
        }
        
        function validateTaxId($taxIdNumber) {
            if (empty($taxIdNumber)) {
                return "";
            } elseif (!preg_match('/^[0-9]+$/', $taxIdNumber)) {
                return "*Must contain numbers only.";
            }
            return $taxIdNumber;
        }
        
        function validateZipcode($zipcode) {
            if (empty($zipcode)) {
                return "";
            } elseif (!preg_match('/^[0-9]+$/', $zipcode)) {
                return "*Must contain numbers only.";
            }
            return $zipcode;
        }

        function validateZipcode2($zipcode2) {
            if (empty($zipcode2)) {
                return "*Field is required.";
            } elseif (!preg_match('/^[0-9]+$/', $zipcode2)) {
                return "*Must contain numbers only.";
            }
            return null;
        }
        
        function validatePhoneNumber($phoneNumber) {
            if (empty($phoneNumber)) {
                return "*Field is required.";
            } elseif (!preg_match('/^[\+0-9\s\(\)-]+$/', $phoneNumber)) {
                return "*Must contain numbers only.";
            }
            return null;
        }

        function validateTeleNumber($teleNumber) {
            if (empty($teleNumber)) {
                return "";
            } elseif (!preg_match('/^[\+0-9\s\(\)-]+$/', $teleNumber)) {
                return "*Must contain numbers only.";
            }
            return null;
        }
        
        function validateEmail($email) {
            if (empty($email)) {
                return "";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return "*Invalid email format.";
            }
            return null;
        }
        
        function validateParentNames($lastName, $firstName, $middleName, $prefix) {
            $errors = [];
        
            if (preg_match('/[0-9]/', $lastName)) {
                $errors[$prefix . '_ln'] = "*Must not contain numbers.";
            }
            if (preg_match('/[0-9]/', $firstName)) {
                $errors[$prefix . '_fn'] = "*Must not contain numbers.";
            }
            if (preg_match('/[0-9]/', $middleName)) {
                $errors[$prefix . '_mn'] = "*Must not contain numbers.";
            }
        
            return ["errors" => $errors];
        }
        
 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // PERSONAL DATA
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
            // PLACE OF BIRTH
            $RFUB = trim($_POST['rfub'] ?? '');
            $HLB = trim($_POST['hlb'] ?? '');
            $street = trim($_POST['street'] ?? '');
            $subdivision = trim($_POST['sub'] ?? '');
            $BDL = trim($_POST['bdl'] ?? '');
            $CM = trim($_POST['cm'] ?? '');
            $province = trim($_POST['prov'] ?? '');
            $zipcode = trim($_POST['zip'] ?? '');
            $country = $_POST['country'] ?? '';
            // HOME ADDRESS
            $RFUB2 = trim($_POST['rfub2'] ?? '');
            $HLB2 = trim($_POST['hlb2'] ?? '');
            $street2 = trim($_POST['street2'] ?? '');
            $subdivision2 = trim($_POST['sub2'] ?? '');
            $BDL2 = trim($_POST['bdl2'] ?? '');
            $CM2 = trim($_POST['cm2'] ?? '');
            $province2 = trim($_POST['prov2'] ?? '');
            $zipcode2 = trim($_POST['zip2'] ?? '');
            $country2 = $_POST['country2'] ?? '';
            // OTHER INFO
            $mobileNumber = trim($_POST['mnum'] ?? '');
            $email = trim($_POST['mail'] ?? '');
            $telephoneNumber = trim($_POST['tele'] ?? '');
            // PARENTS INFO
            $fatherLastName = trim($_POST['f_ln'] ?? '');
            $fatherFirstName = trim($_POST['f_fn'] ?? '');
            $fatherMiddleName = trim($_POST['f_mn'] ?? '');
            $motherLastName = trim($_POST['m_ln'] ?? '');
            $motherFirstName = trim($_POST['m_fn'] ?? '');
            $motherMiddleName = trim($_POST['m_mn'] ?? '');
            // ERROR HANDLING
            $errors['ln'] = validateName($lastName, 'ln');
            $errors['fn'] = validateName($firstName, 'fn');
            $errors['mn'] = validateName($middleInitial, 'mn');
            $errors['dob'] = validateDob($dob);
            $errors['sex'] = empty($sex) ? "*Field is required." : null;
            $errors['civil'] = validateCivilStatus($civilStatus, $otherCivil);
            $tin = validateTaxId($taxIdNumber);
            $errors['tin'] = ($tin === "*Must contain numbers only.") ? $tin : null;
            $errors['nat'] = empty($nationality) ? "*Field is required." : null;
            $reg = empty($religion) ? "" : $religion;
            $errors['rfub'] = empty($RFUB) ? "*Field is required." : null;
            $errors['hlb'] = empty($HLB) ? "*Field is required." : null;
            $errors['street'] = empty($street) ? "*Field is required." : null;
            $sub = empty($subdivision) ? "" : $subdivision;
            $bdl = empty($BDL) ? "" : $BDL;
            $cm = empty($CM) ? "" : $CM;
            $prov = empty($province) ? "" : $province;
            $zc = validateZipcode($zipcode);
            $ctry = empty($country) ? "" : $country;
            $errors['rfub2'] = empty($RFUB2) ? "*Field is required." : null;
            $errors['hlb2'] = empty($HLB2) ? "*Field is required." : null;
            $errors['street2'] = empty($street2) ? "*Field is required." : null;
            $errors['sub2'] = empty($subdivision2) ? "*Field is required." : null;
            $errors['bdl2'] = empty($BDL2) ? "*Field is required." : null;
            $errors['cm2'] = empty($CM2) ? "*Field is required." : null;
            $errors['prov2'] = empty($province2) ? "*Field is required." : null;
            $errors['zip2'] = validateZipcode2($zipcode2);
            $errors['country2'] = empty($country2) ? "*Field is required." : null;
            $errors['mnum'] = validatePhoneNumber($mobileNumber);
            $mail = validateEmail($email);
            $tele = validateTeleNumber($telephoneNumber);
            $fatherValidation = validateParentNames($fatherLastName, $fatherFirstName, $fatherMiddleName, 'f');
            $errors = array_merge($errors, $fatherValidation['errors']);
            $motherValidation = validateParentNames($motherLastName, $motherFirstName, $motherMiddleName, 'm');
            $errors = array_merge($errors, $motherValidation['errors']);
            $civilOpt = CivilArr($civilstats, $_POST['civil'] ?? '');
            $countryOpt = CountryArr($countries, $_POST['country'] ?? '');
            $countryOpt2 = CountryArr($countries, $_POST['country2'] ?? '');
        
            if (empty(array_filter($errors))) {
                $success = true;

                $_SESSION['form_success'] = true;
        
                $_SESSION['form_data'] = [
                    'fn'=> $firstName,'ln'=> $lastName,'mn' => $middleInitial,
                    'dob' => $dob,'sex' => $sex,
                    'cv' => $civilStatus,'ocv' => $otherCivil,
                    'tin' => $tin,'nat' => $nationality,'reg' => $reg,
                    'rfub' => $RFUB,'hlb' => $HLB,'strt' => $street,
                    'sub' => $sub,'bdl' => $bdl,'cm' => $cm,'prov' => $prov,
                    'zip' => $zc,'ctry' => $ctry,'rfub2' => $RFUB2,'hlb2' => $HLB2,
                    'strt2' => $street2,'sub2' => $subdivision2,'bdl2' => $BDL2,
                    'cm2' => $CM2,'prov2' => $province2,'zip2' => $zipcode2,
                    'ctry2' => $country2,'num' => $mobileNumber,'mail' => $mail,
                    'tele' => $tele,'fln' => $fatherLastName,'ffn' => $fatherFirstName,
                    'fmn' => $fatherMiddleName,'mln' => $motherLastName,'mfn' => $motherFirstName,
                    'mmn' => $motherMiddleName
                ];


            $sql = "UPDATE formsdata SET 
                fn = ?, ln = ?, mn = ?, dob = ?, sex = ?, cv = ?, ocv = ?, tin = ?, nat = ?, reg = ?, rfub = ?, hlb = ?, strt = ?, sub = ?, bdl = ?, cm = ?, prov = ?, zip = ?, ctry = ?,
                rfub2 = ?, hlb2 = ?, strt2 = ?, sub2 = ?, bdl2 = ?, cm2 = ?, prov2 = ?, zip2 = ?, ctry2 = ?, num = ?, mail = ?, tele = ?,
                fln = ?, ffn = ?, fmn = ?, mln = ?, mfn = ?, mmn = ? 
                WHERE id = ?";
    
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Error preparing statement: " . $conn->error);
            }

            $stmt->bind_param(
                "ssssssssssssssssssssssssssssssssssssss", 
                $firstName, $lastName, $middleInitial, $dob, $sex, 
                $civilStatus, $otherCivil, $tin, $nationality, $reg,
                $RFUB, $HLB, $street, $sub, $bdl, $cm, $prov, $zc, 
                $ctry, $RFUB2, $HLB2, $street2, $subdivision2, 
                $BDL2, $CM2, $province2, $zipcode2, $country2, $mobileNumber, 
                $mail, $tele, $fatherLastName, $fatherFirstName, $fatherMiddleName, 
                $motherLastName, $motherFirstName, $motherMiddleName, $id
            );
            
            if ($stmt->execute()) {
                echo "Record updated successfully";
            } else {
                die("Error updating record: " . $stmt->error);
            }
    
            $stmt->close();
            $conn->close();
    
            header("Location: view.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Form/styling/style.css">
    <title>PHP Form Validation</title>
</head>
<body>

    <video autoplay muted loop id="bg-video">
        <source src="/Form/files/bgv.mp4" type="video/mp4">
    </video>

    <div class="wrapper">
        <h1>EDIT FORM DATA</h1>

        <form action="" method="POST">
            <div class="input-container">
                <div class="input-box">
                    <Label>Last Name <span class="error"><?php echo $errors['ln'] ?? ''; ?></span></Label>
                    <input type="text" name="ln" value="<?php echo htmlspecialchars($lastName ?? ''); ?>" placeholder="Enter your last name">
                </div>
                <div class="input-box">
                    <Label>First Name <span class="error"><?php echo $errors['fn'] ?? ''; ?></span></Label>
                    <input type="text" name="fn" value="<?php echo htmlspecialchars($firstName ?? ''); ?>" placeholder="Enter your first name">
                </div>
                <div class="input-box">
                    <Label>Middle Initial  <span class="error"><?php echo $errors['mn'] ?? ''; ?></span></Label>
                    <input type="text" name="mn" value="<?php echo htmlspecialchars($middleInitial ?? ''); ?>" placeholder="Enter your middle name">
                </div>
            </div>

            <br><br>

            <div class="input-container">
                <div class="input-box">
                    <Label>Date of Birth <span class="error"><?php echo $errors['dob'] ?? ''; ?></span></Label>
                    <input type="date" name="dob" value="<?php echo htmlspecialchars($dob ?? ''); ?>" >
                </div>
                <div class="input-radio">
                    <Label>Sex <span class="error"><?php echo $errors['sex'] ?? ''; ?></span></Label>
                    <div class="sex-container">
                        <input type="radio" name="sex" value="Male" <?php echo (isset($sex) && $sex == 'Male') ? 'checked' : ''; ?>> Male
                        <input type="radio" name="sex" value="Female" <?php echo (isset($sex) && $sex == 'Female') ? 'checked' : ''; ?>> Female
                    </div>
                </div>
                <div class="input-box">
                    <Label>Civil Status <span class="error"><?php echo $errors['civil'] ?? ''; ?></span></Label>
                    <select name="civil">
                    <?php echo $civilOpt; ?>
                </select>
               
                </div>
            </div>

            <!-- Hidden Input for "Others" -->
            <div class="input-box" id="other-container" style="display: <?php echo (isset($civilStatus) && $civilStatus === 'Other') ? 'block' : 'none'; ?>;">
                <input type="text" name="other_civil_stats" id="other-input" value="<?php echo htmlspecialchars($otherCivil ?? ''); ?>" placeholder="Please specify your status">
            </div>

            <br><br>

            <div class="input-container">
                <div class="input-box">
                    <Label>TIN Number <span class="error"><?php echo $errors['tin'] ?? ''; ?></span></Label>
                    <input type="text" name="tin" value="<?php echo htmlspecialchars($taxIdNumber ?? ''); ?>" placeholder="e.g., 123-456-789-000">
                </div>
                <div class="input-box">
                    <Label>Nationality <span class="error"><?php echo $errors['nat'] ?? ''; ?></span></Label>
                    <input type="text" name="nat" value="<?php echo htmlspecialchars($nationality ?? ''); ?>" placeholder="Enter your nationality">
                </div>
                <div class="input-box">
                    <Label>Religion</Label>
                    <input type="text" name="reg" value="<?php echo htmlspecialchars($religion ?? ''); ?>" placeholder="Enter your religion">
                </div>
            </div>


            <div class="line"></div>

            <h3>Place of Birth</h3>
            
            <div class="input-container">
                <div class="input-box">
                    <Label>RM/FLR/Unit No. & Bldg. Name <span class="error"><?php echo $errors['rfub'] ?? ''; ?></span></Label>
                    <input type="text" name="rfub" value="<?php echo htmlspecialchars($HLB ?? ''); ?>" placeholder="e.g., Unit 5A, Sunset Tower">
                </div>
                <div class="input-box">
                    <Label>House/Lot & Blk. No <span class="error"><?php echo $errors['hlb'] ?? ''; ?></span></Label>
                    <input type="text" name="hlb" value="<?php echo htmlspecialchars($HLB ?? ''); ?>" placeholder="e.g., Lot 15, Block 8">    
                </div>
                <div class="input-box">
                    <Label>Street Name <span class="error"><?php echo $errors['street'] ?? ''; ?></span></Label>
                    <input type="text" name="street" value="<?php echo htmlspecialchars($street ?? ''); ?>" placeholder="e.g., Maple Avenue"> 
                </div>
            </div>

            <br><br>

            <div class="input-container">
                <div class="input-box">
                    <Label>Subdivision</Label>
                    <input type="text" name="sub" value="<?php echo htmlspecialchars($subdivision ?? ''); ?>" placeholder="e.g., Greenfield Heights">
                </div>
                <div class="input-box">
                    <Label>Barangay/District/Locality</Label>
                    <input type="text" name="bdl" value="<?php echo htmlspecialchars($BDL ?? ''); ?>" placeholder="e.g., Barangay 123, Sampaloc">
                </div>
                <div class="input-box">
                    <Label>City/Municipality</Label>
                    <input type="text" name="cm" value="<?php echo htmlspecialchars($CM ?? ''); ?>" placeholder="e.g., Quezon City, Makati">
                </div>
            </div>

            <br><br>

            <div class="input-container">
                <div class="input-box">
                    <Label>Province</Label>
                    <input type="text" name="prov" value="<?php echo htmlspecialchars($province ?? ''); ?>" placeholder="e.g., Laguna, Cavite">
                </div>
                <div class="input-box">
                    <Label>Zip Code <span class="error"><?php echo $errors['zip'] ?? ''; ?></span></Label>
                    <input type="text" name="zip" value="<?php echo htmlspecialchars($zipcode ?? ''); ?>" placeholder="e.g., 1000">
                </div>
                <div class="input-box">
                    <Label>Country</Label>
                    <select name="country" value="<?php echo htmlspecialchars($country ?? ''); ?>" placeholder="e.g., Philippines">
                        <?php echo $countryOpt; ?>
                    </select>   
                </div>
            </div>

            <div class="line"></div>

            <h3>Home Address</h3>
            
            <div class="input-container">
                <div class="input-box">
                    <Label>RM/FLR/Unit No. & Bldg. Name <span class="error"><?php echo $errors['rfub2'] ?? ''; ?></span></Label>
                    <input type="text" name="rfub2" value="<?php echo htmlspecialchars($RFUB2 ?? ''); ?>" placeholder="e.g., Unit 5A, Sunset Tower">
                </div>
                <div class="input-box">
                    <Label>House/Lot & Blk. No <span class="error"><?php echo $errors['hlb2'] ?? ''; ?></span></Label>
                    <input type="text"name="hlb2" value="<?php echo htmlspecialchars($HLB2 ?? ''); ?>" placeholder="e.g., Lot 15, Block 8">    
                </div>
                <div class="input-box">
                    <Label>Street Name <span class="error"><span><?php echo $errors['street2'] ?? ''; ?></span></Label>
                    <input type="text" name="street2" value="<?php echo htmlspecialchars($street2 ?? ''); ?>" placeholder="e.g., Maple Avenue">    
                </div>
            </div>

            <br><br>

            <div class="input-container">
                <div class="input-box">
                    <Label>Subdivision <span class="error"><?php echo $errors['sub2'] ?? ''; ?></span></Label>
                    <input type="text" name="sub2" value="<?php echo htmlspecialchars($subdivision2 ?? ''); ?>" placeholder="e.g., Greenfield Heights">
                </div>
                <div class="input-box">
                    <Label>Barangay/District/Locality   <span class="error"><?php echo $errors['bdl2'] ?? ''; ?></span></Label>
                    <input type="text" name="bdl2" value="<?php echo htmlspecialchars($BDL2 ?? ''); ?>" placeholder="e.g., Barangay 123, Sampaloc"> 
                </div>
                <div class="input-box">
                    <Label>City/Municipality <span class="error"><?php echo $errors['cm2'] ?? ''; ?></span></Label>
                    <input type="text" name="cm2"  value="<?php echo htmlspecialchars($CM2 ?? ''); ?>" placeholder="e.g., Quezon City, Makati">
                </div>
            </div>

            <br><br>

            <div class="input-container">
                <div class="input-box">
                    <Label>Province <span class="error"><?php echo $errors['prov2'] ?? ''; ?></span></Label>
                    <input type="text" name="prov2" value="<?php echo htmlspecialchars($province2 ?? ''); ?>" placeholder="e.g., Laguna, Cavite">                 
                </div>
                <div class="input-box">
                    <Label>Zip Code <span class="error"><?php echo $errors['zip2'] ?? ''; ?></span></Label>
                    <input type="text" name="zip2" value="<?php echo htmlspecialchars($zipcode2 ?? ''); ?>" placeholder="e.g., 1000">
                </div>
                <div class="input-box">
                    <Label>Country <span class="error"><?php echo $errors['country2'] ?? ''; ?></span></Label>
                    <select name="country2" value="<?php echo htmlspecialchars($country2 ?? ''); ?>" placeholder="e.g., Philippines">
                        <?php echo $countryOpt2; ?>
                    </select>   
                </div>
            </div>

            <div class="line"></div>

            <h3>Contact Information</h3>

            <div class="input-container">
                <div class="input-box">
                    <Label>Mobile Number <span class="error"><?php echo $errors['mnum'] ?? ''; ?></span></Label>
                    <input type="tel" name="mnum" value="<?php echo htmlspecialchars($mobileNumber ?? ''); ?>" placeholder="e.g. 0912-345-6789">
                </div>
                <div class="input-box">
                    <Label>Email Address <span class="error"><?php echo $errors['mail'] ?? ''; ?></span></Label>
                    <input type="email" name="mail" value="<?php echo htmlspecialchars($email ?? ''); ?>" placeholder="e.g., sample@email.com">
                </div>
                <div class="input-box">
                    <Label>Telephone Number <span class="error"><?php echo $errors ['tele'] ?? ''; ?></span></Label>
                    <input type="tel" name="tele" value="<?php echo htmlspecialchars($telephoneNumber ?? ''); ?>" placeholder="e.g., 02-1234-5678">
                </div>
            </div>

            <div class="line"></div>

            <h3>Father's Name</h3>

            <div class="input-container">
                <div class="input-box">
                    <Label>Last Name <span class="error"><?php echo $errors['f_ln'] ?? ''; ?></span></Label>
                    <input type="text" name="f_ln" value="<?php echo htmlspecialchars($fatherLastName ?? ''); ?>" placeholder="Enter your father's last name">           
                </div>
                <div class="input-box">
                    <Label>First Name <span class="error"><?php echo $errors['f_fn'] ?? ''; ?></span></Label>
                    <input type="text" name="f_fn" value="<?php echo htmlspecialchars($fatherFirstName ?? ''); ?>" placeholder="Enter your father's first name">                 
                </div>
                <div class="input-box">
                    <Label>Middle Name <span class="error"><?php echo $errors['f_mn'] ?? ''; ?></span></Label>
                    <input type="text" name="f_mn" value="<?php echo htmlspecialchars($fatherMiddleName ?? ''); ?>" placeholder="Enter your father's middle name"> 
                </div>
            </div>

            <div class="line"></div>

            <h3>Mother's Maiden Name</h3>

            <div class="input-container">
                <div class="input-box">
                    <Label>Last Name <span class="error"><?php echo $errors['m_ln'] ?? ''; ?></span></Label>
                    <input type="text" name="m_ln" value="<?php echo htmlspecialchars($motherLastName ?? ''); ?>" placeholder="Enter your mother's last name">            
                </div>
                <div class="input-box">
                    <Label>First Name <span class="error"><?php echo $errors['m_fn'] ?? ''; ?></span></Label>
                    <input type="text" name="m_fn" value="<?php echo htmlspecialchars($motherFirstName ?? ''); ?>" placeholder="Enter your mother's first name">               
                </div>
                <div class="input-box">
                    <Label>Middle Name <span class="error"><?php echo $errors['m_mn'] ?? ''; ?></span></Label>
                    <input type="text" name="m_mn" value="<?php echo htmlspecialchars($motherMiddleName ?? ''); ?>" placeholder="Enter your mother's middle name">               
                </div>
            </div>

            <div class="line"></div>
            
            <div class="button-container">
                <button type="submit" class="submit-btn">Save Changes</button><a href="index.php" class="back-btn" style="margin-left: 15px;">Cancel</a>
            </div>
            </div>
        </form>
    </div>

    <script>     
        document.querySelector('select[name="civil"]').addEventListener('change', function() {
            var otherContainer = document.getElementById('other-container');
            if (this.value === 'Other') {
                otherContainer.style.display = 'block';
            } else {
                otherContainer.style.display = 'none';
            }
        });
    </script>

</body>
</html>