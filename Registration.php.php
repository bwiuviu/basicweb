<html>
<head>
    <style>
        .error {color: #FF0025;}
    </style>
</head>
<body>

<?php
$nameErr = $phoneErr = $emailErr = $dobErr = $photoErr = "";
$name = $phone = $email = $gender = $dob = $address = $bloodGroup = $department = $course = "";
$displayData = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isValid = true;
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $isValid = false;
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
            $nameErr = "Only letters and white space allowed";
            $isValid = false;
        }
    }
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone number is required";
        $isValid = false;
    } else {
        $phone = test_input($_POST["phone"]);
        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $phoneErr = "Phone number must be 10 digits long";
            $isValid = false;
        }
    }
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = $_POST["email"];
        if (!preg_match("/^[a-zA-Z0-9._%+-]+@vitap\.ac\.in$/", $email)) {
            $emailErr = "Invalid email ";
        }
    }
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
        $isValid = false;
    } else {
        $gender = test_input($_POST["gender"]);
    }
    if (empty($_POST["dob"])) {
        $dobErr = "Date of Birth is required";
        $isValid = false;
    } else {
        $dob = test_input($_POST["dob"]);
        if (!preg_match("/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/", $dob)) {
            $dobErr = "Date of Birth must be in DD-MM-YYYY format";
            $isValid = false;
        }
    }
    if (!empty($_POST["address"])) {
        $address = test_input($_POST["address"]);
    }
    if (!empty($_POST["bloodGroup"])) {
        $bloodGroup = test_input($_POST["bloodGroup"]);
    }
    if (!empty($_POST["department"])) {
        $department = test_input($_POST["department"]);
    }
    if (!empty($_POST["course"])) {
        $course = test_input(implode(", ", $_POST["course"]));
    }
    if (isset($_FILES['photo'])) {
        $photo = $_FILES['photo'];
        if ($photo['size'] > 100000) {
            $photoErr = "file size should not be greater than 100KB";
            $isValid = false;
        }
    }
    if ($isValid) {
        $displayData = true;
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<?php if ($displayData): ?>
<h2>Your Input:</h2>
<p>Name: <?php echo $name; ?></p>
<p>Phone Number: <?php echo $phone; ?></p>
<p>Email: <?php echo $email; ?></p>
<p>Gender: <?php echo $gender; ?></p>
<p>Date of Birth: <?php echo $dob; ?></p>
<p>Address: <?php echo $address; ?></p>
<p>Blood Group: <?php echo $bloodGroup; ?></p>
<p>Department: <?php echo $department; ?></p>
<p>Course: <?php echo $course; ?></p>
<?php else: ?>
<h2>Student Registration Form</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
    Name: <input type="text" name="name" value="<?php echo $name; ?>">
    <span class="error"> <?php echo $nameErr; ?></span>
    <br><br>

    Phone Number: <input type="text" name="phone" value="<?php echo $phone; ?>">
    <span class="error"><?php echo $phoneErr; ?></span>
    <br><br>

    Email: <input type="text" name="email" value="<?php echo $email; ?>">
    <span class="error"> <?php echo $emailErr; ?></span>
    <br><br>

    Gender:
    <input type="radio" name="gender" value="Male" <?php if ($gender == "Male") echo "checked"; ?>> Male
    <input type="radio" name="gender" value="Female" <?php if ($gender == "Female") echo "checked"; ?>> Female
    <br><br>

    Date of Birth: <input type="text" name="dob" value="<?php echo $dob; ?>">
    <span class="error"> <?php echo $dobErr; ?></span>
    <br><br>

    Address: <textarea name="address" rows="6" cols="30"><?php echo $address; ?></textarea>
    <br><br>

    Blood Group:
    <select name="bloodGroup">
        <option value="">Select</option>
        <option value="O+" <?php if ($bloodGroup == "O+") echo "selected"; ?>>O+</option>
        <option value="O-" <?php if ($bloodGroup == "O-") echo "selected"; ?>>O-</option>
        <option value="A+" <?php if ($bloodGroup == "A+") echo "selected"; ?>>A+</option>
        <option value="A-" <?php if ($bloodGroup == "A-") echo "selected"; ?>>A-</option>
        <option value="B+" <?php if ($bloodGroup == "B+") echo "selected"; ?>>B+</option>
        <option value="B-" <?php if ($bloodGroup == "B-") echo "selected"; ?>>B-</option>
    </select>
    <br><br>

    Department:
    <input type="radio" name="department" value="CSE" <?php if ($department == "CSE") echo "checked"; ?>> CSE
    <input type="radio" name="department" value="MEC" <?php if ($department == "MEC") echo "checked"; ?>> MEC
    <input type="radio" name="department" value="EEE" <?php if ($department == "EEE") echo "checked"; ?>> EEE
    <br><br>

    Course:
    <input type="checkbox" name="course[]" value="C" <?php if (strpos($course, "C") !== false) echo "checked"; ?>> C
    <input type="checkbox" name="course[]" value="C++" <?php if (strpos($course, "C++") !== false) echo "checked"; ?>> C++
    <input type="checkbox" name="course[]" value="Java" <?php if (strpos($course, "Java") !== false) echo "checked"; ?>> Java
    <input type="checkbox" name="course[]" value="PYTHON" <?php if (strpos($course, "PYTHON") !== false) echo "checked"; ?>> PYTHON
    <br><br>

    Photo: <input type="file" name="photo">
    <span class="error"> <?php echo $photoErr; ?></span>
    <br><br>

    <input type="submit" name="submit" value="Submit">
    <input type="reset" value="Reset">
</form>
<?php endif; ?>

</body>
</html>