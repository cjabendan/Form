<?php
session_start();

require_once __DIR__ . "/Controller/FormController.php";
require_once __DIR__ . "/Model/Session.php";
require_once __DIR__ . "/Database/database.php";

$formController = new FormController($conn);

$formController->handleRequest();

$data = new FormSessionData($_SESSION['form_data'] ?? []);
$errors = $_SESSION['form_errors'] ?? [];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="/Styling/style.css">
    <title>PHP Form Validation</title>
</head>
<body>

   <video autoplay muted loop id="bg-video">
        <source src="/Files/bgv.mp4" type="video/mp4">
    </video>


    <div class="wrapper">
        <h1>PERSONAL DATA</h1>  
        <form action="" method="POST">
            <div class="input-container"> 
                <div class="input-box">
                    <Label>Last Name <span class="error"><?php echo $errors['ln'] ?? ''; ?></span></Label>
                    <input type="text" name="ln" value="<?php echo htmlspecialchars($data->lastName ?? ''); ?>" placeholder="Enter your last name">
                </div>
                <div class="input-box">
                    <Label>First Name <span class="error"><?php echo $errors['fn'] ?? ''; ?></span></Label>
                    <input type="text" name="fn" value="<?php echo htmlspecialchars($data->firstName ?? ''); ?>" placeholder="Enter your first name">
                </div>
                <div class="input-box">
                    <Label>Middle Initial  <span class="error"><?php echo $errors['mn'] ?? ''; ?></span></Label>
                    <input type="text" name="mn" value="<?php echo htmlspecialchars($data->middleInitial ?? ''); ?>" placeholder="Enter your middle name">
                </div>
            </div>

            <br><br>

            <div class="input-container">
                <div class="input-box">
                    <Label>Date of Birth <span class="error"><?php echo $errors['dob'] ?? ''; ?></span></Label>
                    <input type="date" name="dob" value="<?php echo htmlspecialchars($data->dob ?? ''); ?>">
                </div>
                <div class="input-radio">
                    <Label>Sex <span class="error"><?php echo $errors['sex'] ?? ''; ?></span></Label>
                    <div class="sex-container">
                        <input type="radio" name="sex" value="Male" <?php echo ($data->sex == 'Male') ? 'checked' : ''; ?>> Male
                        <input type="radio" name="sex" value="Female" <?php echo ($data->sex == 'Female') ? 'checked' : ''; ?>> Female
                    </div>
                </div>
                <div class="input-box">
                    <Label>Civil Status <span class="error"><?php echo $errors['civil'] ?? ''; ?></span></Label>
                    <select name="civil">
                        <?= CivilStatus::getOptions($data->civilStatus) ?>
                    </select>
                </div>
            </div>

            <!-- Hidden Input for "Others" -->
            <div class="input-box" id="other-container" style="display: <?php echo (isset($data->civilStatus) && $data->civilStatus === 'Other') ? 'block' : 'none'; ?>;">
                <input type="text" name="other_civil_stats" id="other-input" value="<?php echo htmlspecialchars($data->otherCivil ?? ''); ?>" placeholder="Please specify your status">
            </div>

            <br><br>

            <div class="input-container">
                <div class="input-box">
                    <Label>TIN Number <span class="error"><?php echo $errors['tin'] ?? ''; ?></span></Label>
                    <input type="text" name="tin" value="<?php echo htmlspecialchars($data->taxIdNumber ?? ''); ?>" placeholder="e.g., 123-456-789-000">
                </div>
                <div class="input-box">
                    <Label>Nationality <span class="error"><?php echo $errors['nat'] ?? ''; ?></span></Label>
                    <input type="text" name="nat" value="<?php echo htmlspecialchars($data->nationality ?? ''); ?>" placeholder="Enter your nationality">
                </div>
                <div class="input-box">
                    <Label>Religion</Label>
                    <input type="text" name="reg" value="<?php echo htmlspecialchars($data->religion ?? ''); ?>" placeholder="Enter your religion">
                </div>
            </div>

            <div class="line"></div>

            <h3>Place of Birth</h3>
            <div class="input-container">
                <div class="input-box">
                    <Label>RM/FLR/Unit No. & Bldg. Name <span class="error"><?php echo $errors['rfub'] ?? ''; ?></span></Label>
                    <input type="text" name="rfub" value="<?php echo htmlspecialchars($data->RFUB ?? ''); ?>" placeholder="e.g., Unit 5A, Sunset Tower">
                </div>
                <div class="input-box">
                    <Label>House/Lot & Blk. No <span class="error"><?php echo $errors['hlb'] ?? ''; ?></span></Label>
                    <input type="text" name="hlb" value="<?php echo htmlspecialchars($data->HLB ?? ''); ?>" placeholder="e.g., Lot 15, Block 8">    
                </div>
                <div class="input-box">
                    <Label>Street Name <span class="error"><?php echo $errors['street'] ?? ''; ?></span></Label>
                    <input type="text" name="street" value="<?php echo htmlspecialchars($data->street ?? ''); ?>" placeholder="e.g., Maple Avenue"> 
                </div>
            </div>

            <br><br>

            <div class="input-container">
                <div class="input-box">
                    <Label>Subdivision</Label>
                    <input type="text" name="sub" value="<?php echo htmlspecialchars($data->subdivision ?? ''); ?>" placeholder="e.g., Greenfield Heights">
                </div>
                <div class="input-box">
                    <Label>Barangay/District/Locality</Label>
                    <input type="text" name="bdl" value="<?php echo htmlspecialchars($data->BDL ?? ''); ?>" placeholder="e.g., Barangay 123, Sampaloc">
                </div>
                <div class="input-box">
                    <Label>City/Municipality</Label>
                    <input type="text" name="cm" value="<?php echo htmlspecialchars($data->CM ?? ''); ?>" placeholder="e.g., Quezon City, Makati">
                </div>
            </div>

            <br><br>

            <div class="input-container">
                <div class="input-box">
                    <Label>Province</Label>
                    <input type="text" name="prov" value="<?php echo htmlspecialchars($data->province ?? ''); ?>" placeholder="e.g., Laguna, Cavite">
                </div>
                <div class="input-box">
                    <Label>Zip Code <span class="error"><?php echo $errors['zip'] ?? ''; ?></span></Label>
                    <input type="text" name="zip" value="<?php echo htmlspecialchars($data->zipcode ?? ''); ?>" placeholder="e.g., 1000">
                </div>
                <div class="input-box">
                    <Label>Country</Label>
                    <select name="country">
                        <?= Countries::getOptions($data->country) ?>
                    </select>   
                </div>
            </div>

            <div class="line"></div>

            <h3>Home Address</h3>
            
            <div class="input-container">
                <div class="input-box">
                    <Label>RM/FLR/Unit No. & Bldg. Name <span class="error"><?php echo $errors['rfub2'] ?? ''; ?></span></Label>
                    <input type="text" name="rfub2" value="<?php echo htmlspecialchars($data->RFUB2 ?? ''); ?>" placeholder="e.g., Unit 5A, Sunset Tower">
                </div>
                <div class="input-box">
                    <Label>House/Lot & Blk. No <span class="error"><?php echo $errors['hlb2'] ?? ''; ?></span></Label>
                    <input type="text" name="hlb2" value="<?php echo htmlspecialchars($data->HLB2 ?? ''); ?>" placeholder="e.g., Lot 15, Block 8">    
                </div>
                <div class="input-box">
                    <Label>Street Name <span class="error"><?php echo $errors['street2'] ?? ''; ?></span></Label>
                    <input type="text" name="street2" value="<?php echo htmlspecialchars($data->street2 ?? ''); ?>" placeholder="e.g., Maple Avenue">    
                </div>
            </div>

            <br><br>

            <div class="input-container">
                <div class="input-box">
                    <Label>Subdivision <span class="error"><?php echo $errors['sub2'] ?? ''; ?></span></Label>
                    <input type="text" name="sub2" value="<?php echo htmlspecialchars($data->subdivision2 ?? ''); ?>" placeholder="e.g., Greenfield Heights">
                </div>
                <div class="input-box">
                    <Label>Barangay/District/Locality <span class="error"><?php echo $errors['bdl2'] ?? ''; ?></span></Label>
                    <input type="text" name="bdl2" value="<?php echo htmlspecialchars($data->BDL2 ?? ''); ?>" placeholder="e.g., Barangay 123, Sampaloc"> 
                </div>
                <div class="input-box">
                    <Label>City/Municipality <span class="error"><?php echo $errors['cm2'] ?? ''; ?></span></Label>
                    <input type="text" name="cm2" value="<?php echo htmlspecialchars($data->CM2 ?? ''); ?>" placeholder="e.g., Quezon City, Makati">
                </div>
            </div>

            <br><br>

            <div class="input-container">
                <div class="input-box">
                    <Label>Province <span class="error"><?php echo $errors['prov2'] ?? ''; ?></span></Label>
                    <input type="text" name="prov2" value="<?php echo htmlspecialchars($data->province2 ?? ''); ?>" placeholder="e.g., Laguna, Cavite">                 
                </div>
                <div class="input-box">
                    <Label>Zip Code <span class="error"><?php echo $errors['zip2'] ?? ''; ?></span></Label>
                    <input type="text" name="zip2" value="<?php echo htmlspecialchars($data->zipcode2 ?? ''); ?>" placeholder="e.g., 1000">
                </div>
                <div class="input-box">
                    <Label>Country <span class="error"><?php echo $errors['country2'] ?? ''; ?></span></Label>
                    <select name="country2">
                    <?= Countries::getOptions($data->country2) ?>
                    </select>   
                </div>
            </div>

            <div class="line"></div>

            <h3>Contact Information</h3>

            <div class="input-container">
                <div class="input-box">
                    <Label>Mobile Number <span class="error"><?php echo $errors['mnum'] ?? ''; ?></span></Label>
                    <input type="tel" name="mnum" value="<?php echo htmlspecialchars($data->mobileNumber ?? ''); ?>" placeholder="e.g. 0912-345-6789">
                </div>
                <div class="input-box">
                    <Label>Email Address <span class="error"><?php echo $errors['mail'] ?? ''; ?></span></Label>
                    <input type="email" name="mail" value="<?php echo htmlspecialchars($data->email ?? ''); ?>" placeholder="e.g., sample@email.com">
                </div>
                <div class="input-box">
                    <Label>Telephone Number <span class="error"><?php echo $errors['tele'] ?? ''; ?></span></Label>
                    <input type="tel" name="tele" value="<?php echo htmlspecialchars($data->telephoneNumber ?? ''); ?>" placeholder="e.g., 02-1234-5678">
                </div>
            </div>

            <div class="line"></div>

            <h3>Father's Name</h3>

            <div class="input-container">
                <div class="input-box">
                    <Label>Last Name <span class="error"><?php echo $errors['f_ln'] ?? ''; ?></span></Label>
                    <input type="text" name="f_ln" value="<?php echo htmlspecialchars($data->fatherLastName ?? ''); ?>" placeholder="Enter your father's last name">           
                </div>
                <div class="input-box">
                    <Label>First Name <span class="error"><?php echo $errors['f_fn'] ?? ''; ?></span></Label>
                    <input type="text" name="f_fn" value="<?php echo htmlspecialchars($data->fatherFirstName ?? ''); ?>" placeholder="Enter your father's first name">                 
                </div>
                <div class="input-box">
                    <Label>Middle Name <span class="error"><?php echo $errors['f_mn'] ?? ''; ?></span></Label>
                    <input type="text" name="f_mn" value="<?php echo htmlspecialchars($data->fatherMiddleName ?? ''); ?>" placeholder="Enter your father's middle name"> 
                </div>
            </div>

            <div class="line"></div>

            <h3>Mother's Maiden Name</h3>

            <div class="input-container">
                <div class="input-box">
                    <Label>Last Name <span class="error"><?php echo $errors['m_ln'] ?? ''; ?></span></Label>
                    <input type="text" name="m_ln" value="<?php echo htmlspecialchars($data->motherLastName ?? ''); ?>" placeholder="Enter your mother's last name">            
                </div>
                <div class="input-box">
                    <Label>First Name <span class="error"><?php echo $errors['m_fn'] ?? ''; ?></span></Label>
                    <input type="text" name="m_fn" value="<?php echo htmlspecialchars($data->motherFirstName ?? ''); ?>" placeholder="Enter your mother's first name">               
                </div>
                <div class="input-box">
                    <Label>Middle Name <span class="error"><?php echo $errors['m_mn'] ?? ''; ?></span></Label>
                    <input type="text" name="m_mn" value="<?php echo htmlspecialchars($data->motherMiddleName ?? ''); ?>" placeholder="Enter your mother's middle name">               
                </div>
            </div>

            <div class="line"></div>
            
            <div class="button-container">
                <button type="submit" class="submit-btn">Submit Form</button>
                <a href="/index.php" class="back-btn" style="margin-left: 15px;">Cancel</a>
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