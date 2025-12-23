<?php
 include 'header.php';
?>
<?php
if(file_exists('students.txt')){
    try {
    $file = 'students.txt'; 
    $myFile = fopen($file, 'r');
    $file_content = fread($myFile, filesize($file));
    echo nl2br($file_content);

    fclose($myFile);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
    
} else {
    echo "File not found";
   
}


?>
<main>
    <button><a href="index.php">Back</a></button>
</main>

<?php
 include 'footer.php';
?>