<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />  
<head>
    <title>Gracias por la inscripción</title>       
    <img src="./wp-content/uploads/Rugby-Tres-Cantos-Banner.jpg" alt="banner" width="70%" align="center" />                                       
</head> 

<body>
    <h1>
        <?php echo 'Gracias, '.$_POST["name"] ?>
    </h1>
    <p>
        Su petición será procesada en los próximos días.
        <a href="http://www.rugbytrescantos.com/inscription.php">Volver a la página de inscripción</a>
    </p>
    <?php
              # id, dni, name, surname, address, city, zipcode, phone,
              # cellphone, email, second_email, bank, birthdate, sex, 
         $date = $_POST["birthdate"];
         $birthday = date('d-m-Y', strtotime($date));
         $data = array("", $_POST["dni"], $_POST["name"], $_POST["surname"], $_POST["address"], $_POST["city"], $_POST["zipcode"], "",
             $_POST["phone"], $_POST["email"], "", 0, $birthday, $_POST["sex"]);
         $filename = 'preinscripciones_'.date('Ymd', time()).'.csv';
         $fp = fopen($filename, 'a');
         fputcsv($fp, $data);
         if ($_POST["parentDni1"] != "")
         {
            $parentData = array("", $_POST["parentDni1"], $_POST["parentName1"], $_POST["parentSurname1"], $_POST["parentDni2"], $_POST["parentName2"], $_POST["parentSurname2"]);
            fputcsv($fp, $parentData);
         }
         fclose($fp);
         $target_dir = "pictures".date('Ymd', time())."/";
         if (is_dir($target_dir) === False)
            mkdir($target_dir, 0755);
         $uploadOk = 1;

         $target_file = $target_dir . basename($_FILES["dniFront"]["name"]);
         $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
         $target_file = $target_dir . basename($_POST["surname"].'_'.$_POST["name"]."_dniDelantero.".$imageFileType);
         move_uploaded_file($_FILES["dniFront"]["tmp_name"], $target_file);

         $target_file = $target_dir . basename($_FILES["dniBack"]["name"]);
         $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
         $target_file = $target_dir . basename($_POST["surname"].'_'.$_POST["name"]."_dniTrasero.".$imageFileType);
         move_uploaded_file($_FILES["dniBack"]["tmp_name"], $target_file);

         $target_file = $target_dir . basename($_FILES["justificante"]["name"]);
         $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
         $target_file = $target_dir . basename($_POST["surname"].'_'.$_POST["name"]."_justificante.".$imageFileType);
         move_uploaded_file($_FILES["justificante"]["tmp_name"], $target_file);

         $target_file = $target_dir . basename($_FILES["familyBook"]["name"]);
         $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
         $target_file = $target_dir . basename($_POST["surname"].'_'.$_POST["name"]."_libroFamilia.".$imageFileType);
         move_uploaded_file($_FILES["familyBook"]["tmp_name"], $target_file);

         $target_file = $target_dir . basename($_FILES["healtySystemCard"]["name"]);
         $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
         $target_file = $target_dir . basename($_POST["surname"].'_'.$_POST["name"]."_tarjetaSanitaria.".$imageFileType);
         move_uploaded_file($_FILES["healtySystemCard"]["tmp_name"], $target_file);

         if(isset($_POST["submit"])) {
             $check = getimagesize($_FILES["dniFront"]["tmp_name"]);
             if($check !== false) {
                 echo "File is an image - " . $check["mime"] . ".";

                 $uploadOk = 1;
             } else {
                 echo "File is not an image.";
                 $uploadOk = 0;
             }
         }
    ?>
</body>
</html>
