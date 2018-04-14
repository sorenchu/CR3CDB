<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
    <style>
    .error {color: #FF0000;}
    </style>
    <title>Formulario de inscripción - Temporada 2018/19</title>
    <img src="./wp-content/uploads/Rugby-Tres-Cantos-Banner.jpg" alt="banner" width="70%" align="center" />
</head>

<?php
    $nameErr = $surnameErr = $dniErr = $lopdErr = "";
    $name = $surname = $dni = $birthdate = $gender = $phone = $email = $address = $city = $zipcode = $province = $lopd = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Debe introducir su nombre";
        } else {
            $name = input($_POST["name"]);
        }

        if (empty($_POST["surname"])) {
            $surnameErr = "Debe introducir sus apellidos";
        } else {
            $surname = input($_POST["surname"]);
        }

        if (empty($_POST["dni"])) {
            $dniErr = "Debe introducir su dni";
        } else {
            $dni = input($_POST["dni"]);
        }

        if (empty($_POST["lopd"])) {
            $lopdErr = "Debe aceptar nuestros términos de protección de datos para continuar";
        } else {
            $lopd = input($_POST["lopd"]);
        }
    }

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<body>
    <div id="container">
        <h1>Formulario de inscripción - Temporada 2018/19</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Nombre <span class="error">*</span> <input type="text" name="name"> <span class="error"><?php echo $nameErr;?></span><br>
            Apellidos <span class="error">*</span> <input type="text" name="surname"><span class="error"><?php echo $surnameErr;?></span><br>
            Dni <span class="error">*</span> <input type="text" name="dni"><span class="error"><?php echo $dniErr;?></span><br>
            Fecha de Nacimiento <input type="date" name="birthdate"><br>
            Género <select name="sex">
                        <option value="hombre">Hombre</option>
                        <option value="female">Mujer</option>
                   </select>
            <hr>
            Teléfono <input type="tel" name="phone"><br>
            Correo Electrónico <input type="email" name="email"><br>
            Dirección <input type="text" name="address"><br>
            Ciudad <input type="text" name="city"><br>
            Código postal <input type="text" name="zipcode"><br>
            Provincia <input type="text" name="province"><br>
            <hr>
            Acepto que el Club de Rugby Tres Cantos trate los datos proporcionados con arreglo a la LOPD <input type="checkbox" name="lopd"><span class="error"><?php echo $lopdErr;?></span><br>
            <hr>
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>
</html>


        <!-- <form action="/thanks.php" method="post"> -->
