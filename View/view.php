<?php
session_start();
require_once __DIR__ . "/../Database/database.php";

if (!isset($_SESSION['formData'])) {
    header("Location: /index.php");
    exit();
}

$formData = $_SESSION['formData'];
$age = $_SESSION['age'];
$pageTitle = $_SESSION['pageTitle'];

function getFormDataValue($field)
{
    return !empty($field) ? htmlspecialchars($field) : "N/A";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="/Styling/style.css">
    <title><?php echo $pageTitle; ?></title>
</head>

<body>

<video autoplay muted loop id="bg-video">
        <source src="/Files/bgv.mp4" type="video/mp4">
    </video>


    <div class="wrapper">
        <h1><?php echo $pageTitle; ?></h1>
        <h3>Personal Data</h3>
        <div class="form-group">
            <Label>Full Name:</Label>
            <p><?php echo getFormDataValue($formData['ln']) . ', ' . getFormDataValue($formData['fn']) . ' ' . getFormDataValue($formData['mn']); ?></p>
        </div>
        <div class="form-row">
            <div class="form-group">
                <Label>Date of Birth:</Label>
                <p><?php echo getFormDataValue($formData['dob']); ?></p>
            </div>
            <div class="form-group">
                <Label>Age:</Label>
                <p><?php echo $age; ?></p>
            </div>
            <div class="form-group">
                <Label>Sex:</Label>
                <p><?php echo getFormDataValue($formData['sex']); ?></p>
            </div>
            <div class="form-group">
                <Label>Civil Status:</Label>
                <p><?php echo getFormDataValue($formData['cv']); ?></p>
            </div>
            <div class="form-group">
                <Label>Other Civil Status:</Label>
                <p><?php echo getFormDataValue($formData['ocv'] ?? ''); ?></p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <Label>Tax Identification Number:</Label>
                <p><?php echo getFormDataValue($formData['tin']); ?></p>
            </div>
            <div class="form-group">
                <Label>Nationality:</Label>
                <p><?php echo getFormDataValue($formData['nat']); ?></p>
            </div>
            <div class="form-group">
                <Label>Religion:</Label>
                <p><?php echo getFormDataValue($formData['reg']); ?></p>
            </div>
        </div>
        <br>
        <h3>Place of Birth</h3>
        <div class="form-row">
            <div class="form-group">
                <Label>Room/Floor:</Label>
                <p><?php echo getFormDataValue($formData['rfub']); ?></p>
            </div>
            <div class="form-group">
                <Label>House/Lot/Block:</Label>
                <p><?php echo getFormDataValue($formData['hlb']); ?></p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <Label>Street:</Label>
                <p><?php echo getFormDataValue($formData['strt']); ?></p>
            </div>
            <div class="form-group">
                <Label>Subdivision:</Label>
                <p><?php echo getFormDataValue($formData['sub']); ?></p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <Label>Barangay/District:</Label>
                <p><?php echo getFormDataValue($formData['bdl']); ?></p>
            </div>
            <div class="form-group">
                <Label>City/Municipality:</Label>
                <p><?php echo getFormDataValue($formData['cm']); ?></p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <Label>Province:</Label>
                <p><?php echo getFormDataValue($formData['prov']); ?></p>
            </div>
            <div class="form-group">
                <Label>ZIP Code:</Label>
                <p><?php echo getFormDataValue($formData['zip']); ?></p>
            </div>
            <div class="form-group">
                <Label>Country:</Label>
                <p><?php echo getFormDataValue($formData['ctry']); ?></p>
            </div>
        </div>
        <br>
        <h3>Home Address</h3>
        <div class="form-row">
            <div class="form-group">
                <Label>Room/Floor:</Label>
                <p><?php echo getFormDataValue($formData['rfub2']); ?></p>
            </div>
            <div class="form-group">
                <Label>House/Lot/Block:</Label>
                <p><?php echo getFormDataValue($formData['hlb2']); ?></p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <Label>Street:</Label>
                <p><?php echo getFormDataValue($formData['strt2']); ?></p>
            </div>
            <div class="form-group">
                <Label>Subdivision:</Label>
                <p><?php echo getFormDataValue($formData['sub2']); ?></p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <Label>Barangay/District:</Label>
                <p><?php echo getFormDataValue($formData['bdl2']); ?></p>
            </div>
            <div class="form-group">
                <Label>City/Municipality:</Label>
                <p><?php echo getFormDataValue($formData['cm2']); ?></p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <Label>Province:</Label>
                <p><?php echo getFormDataValue($formData['prov2']); ?></p>
            </div>
            <div class="form-group">
                <Label>ZIP Code:</Label>
                <p><?php echo getFormDataValue($formData['zip2']); ?></p>
            </div>
            <div class="form-group">
                <Label>Country:</Label>
                <p><?php echo getFormDataValue($formData['ctry2']); ?></p>
            </div>
        </div>
        <h3>Contact Information</h3>
        <div class="form-group">
            <Label>Email Address:</Label>
            <p><?php echo getFormDataValue($formData['mail']); ?></p>
        </div>
        <div class="form-row">
            <div class="form-group">
                <Label>Mobile Number:</Label>
                <p><?php echo getFormDataValue($formData['num']); ?></p>
            </div>
            <div class="form-group">
                <Label>Telephone Number:</Label>
                <p><?php echo getFormDataValue($formData['tele']); ?></p>
            </div>
        </div>
        <br>
        <h3>Parental Information</h3>
        <div class="form-group">
            <Label>Father's Name:</Label>
            <p>
                <?php
                if (empty($formData['ffn']) && empty($formData['fmn']) && empty($formData['fln'])) {
                    echo "N/A";
                } else {
                    echo htmlspecialchars($formData['ffn']) . ' ' . htmlspecialchars($formData['fmn']) . ' ' . htmlspecialchars($formData['fln']);
                }
                ?>
            </p>
        </div>
        <div class="form-group">
            <Label>Mother's Maiden Name:</Label>
            <p>
                <?php
                if (empty($formData['mfn']) && empty($formData['mmn']) && empty($formData['mln'])) {
                    echo "N/A";
                } else {
                    echo htmlspecialchars($formData['mfn']) . ' ' . htmlspecialchars($formData['mmn']) . ' ' . htmlspecialchars($formData['mln']);
                }
                ?>
            </p>
        </div>
        <br>
        <div class="button-container">
            <a href="/index.php" class="back-btn">Go Back</a>
        </div>
    </div>
</body>

</html>