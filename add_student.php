<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>
<form action="" method="POST">
<label for="name"> Name</label>
<input type="text" name="name" id="name" placeholder="name">

<label for="email"> Email</label>
<input type="email" name="email" placeholder="email" id="email">

<label for="skills">skills</label>
<input type="text" placeholder="comma separated" name="skills" id="skills">

<input type="submit" name="submit">
<button><a href="index.php">Back</a></button>
</form>
</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
$raw_name = $_POST['name'];
$raw_email = $_POST['email'];
$raw_skills = $_POST['skills'];

$name = trim($raw_name);
$email = trim($raw_email);
$skills = trim($raw_skills);

if(isset($_POST['submit'])){
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
echo "Invalid email format";
}else{
echo "Student added successfully! <br>";
//echo "Name: " . $name . "<br>";
//echo "Email: " . $email . "<br>";
//echo "Skills: " . $skills . "<br>";
    }
  }

$array_skills = explode(',', $skills);
try{
$file = 'students.txt';
$student_data = "Name: " . $name . ", Email: " . $email . ", Skills: " . implode('; ', $array_skills) . PHP_EOL;
$myFile = fopen($file, 'a');
if($myFile){
fwrite($myFile, $student_data);
fclose($myFile);
echo "Data written to file successfully.";
}else{
echo "Unable to open file.";
}  

}catch(Exception $e){
echo "Error: " . $e->getMessage();

}
}  
?>
