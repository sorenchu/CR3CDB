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
        <a href="http://www.rugbytrescantos.com">Volver a la página principal</a>
    </p>
    <?php
              # id, dni, name, surname, address, city, zipcode, phone,
              # cellphone, email, second_email, bank, birthdate, sex, 
         $date = $_POST["birthdate"];
         $birthday = date('d-m-Y', strtotime($date));
         $data = array("999999", $_POST["dni"], $_POST["name"], $_POST["surname"], $_POST["address"], $_POST["city"], $_POST["zipcode"], "",
             $_POST["phone"], $_POST["email"], "", 0, $birthday, $_POST["sex"]);
         $filename = 'preinscripciones_'.date('dmY', time()).'.csv';
         $fp = fopen($filename, 'a');
         fputcsv($fp, $data);
         fclose($fp);
    ?>
</body>
</html>
