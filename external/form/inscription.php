<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
    <style>
    .error {color: #FF0000;}
    </style>
    <title>Formulario de inscripción - Temporada 2018/19</title>
    <img src="./wp-content/uploads/Rugby-Tres-Cantos-Banner.jpg" alt="banner" width="70%" align="center" />
</head>

<body>
    <div id="container">
        <h1>Formulario de inscripción - Temporada 2018/19</h1>
         <form method="post" id="inscription" name="inscription" action="./thanks.php" onsubmit="return validate(true);" enctype="multipart/form-data">
            <p id="name"></p>
            <p id="surname"></p>
            <p id="dni"></p>
            <script>
                var lopdErr = "";
                var underagePerson = false;
                var dniFrontErr = "", dniBackErr = "", healthySystemCardErr = "", familyBookErr = "";
                var parentNameErr, parentSurnameErr, parentDniErr;
                function underAge(e){
                  var str = e.target.value.split('-');
                  var formDate = new Date(str[0], str[1]-1, str[2]);
                  var today = new Date();
                  var timeDiff = Math.abs((today - formDate) / 31556952000);
                  if (timeDiff >= 18) {
                    document.getElementById("underAge").innerHTML='DNI delantero <span class="error">*</span> <input type="file" name="dniFront" id="dniFront" accept="image/*" /><span class="error"> ' + dniFrontErr + '</span><br>';
                    document.getElementById("underAge").innerHTML+='DNI trasero <span class="error">*</span> <input type="file" name="dniBack" id="dniBack" accept="image/*" /><span class="error">' + dniBackErr + '</span><br>';
                    document.getElementById("underAge").innerHTML+='Justificante de pago: <input type="file" name="justificante" id="justificante" accept="image/*" /><br>';
                    document.getElementById("parentData").innerHTML="";
                    underagePerson = false;
                  }
                  else {
                    // Pictures
                    document.getElementById("underAge").innerHTML='DNI delantero <span class="error">**</span> <input type="file" name="dniFront" accept="image/*" /><span class="error">' + dniFrontErr + '</span><br>';
                    document.getElementById("underAge").innerHTML+='DNI trasero <span class="error">**</span> <input type="file" name="dniBack" accept="image/*" /><span class="error">' + dniBackErr + '</span><br>';
                    document.getElementById("underAge").innerHTML+='Libro de familia <span class="error">**</span> <input type="file" name="familyBook" accept="image/*" /><span class="error">' + familyBookErr + '</span><br>';
                    document.getElementById("underAge").innerHTML+='Tarjeta sanitaria <span class="error">**</span> <input type="file" name="healthySystemCard" accept="image/*" /><span class="error">' + healthySystemCardErr + '</span><br>';
                    document.getElementById("underAge").innerHTML+='Justificante de pago: <input type="file" name="justificante" id="justificante" accept="image/*" /><br>';
                    document.getElementById("underAge").innerHTML+='<span class="error">(**) Es necesario añadir el DNI del jugador o bien libro de familia y tarjeta sanitaria</span><br>';

                    // Parent data
                    if (parentNameErr !== undefined)
                        document.getElementById("parentData").innerHTML='Nombre del padre/madre <span class="error">*</span> <input type="text" name="parentName1" id="parentName1"> <span class="error">' + parentNameErr + '</span><br>';
                    else
                        document.getElementById("parentData").innerHTML='Nombre del padre/madre <span class="error">*</span> <input type="text" name="parentName1" id="parentName1"> <span class="error"></span><br>';
                    if (parentSurnameErr !== undefined)
                        document.getElementById("parentData").innerHTML+='Apellidos del padre/madre <span class="error">*</span> <input type="text" name="parentSurname1" id="parentSurname1"> <span class="error">' + parentSurnameErr + '</span><br>';
                    else
                        document.getElementById("parentData").innerHTML+='Apellidos del padre/madre <span class="error">*</span> <input type="text" name="parentSurname1" id="parentSurname1"> <span class="error"></span><br>';
                    if (parentDniErr !== undefined)
                        document.getElementById("parentData").innerHTML+='DNI del padre/madre <span class="error">*</span> <input type="text" name="parentDni1" id="parentDni1"> <span class="error">' + parentDniErr + '</span><br><hr>';
                    else
                        document.getElementById("parentData").innerHTML+='DNI del padre/madre <span class="error">*</span> <input type="text" name="parentDni1" id="parentDni1"> <span class="error"></span><br><hr>';
                    document.getElementById("parentData").innerHTML+='Nombre del padre/madre <input type="text" name="parentName2"> <br>';
                    document.getElementById("parentData").innerHTML+='Apellidos del padre/madre <input type="text" name="parentSurname2"> <br>';
                    document.getElementById("parentData").innerHTML+='DNI del padre/madre <input type="text" name="parentDni2"> <br><hr>';
                    underagePerson = true;
                  }
                }
            </script>
            <p id="birthdate"></p>
            Género <select name="sex">
                        <option value="hombre">Hombre</option>
                        <option value="female">Mujer</option>
                   </select>
            <hr>
            <p id="parentData"></p>
            Teléfono <input type="tel" name="phone" value="<?php echo $phone;?>"><br>
            Correo Electrónico <input type="email" name="email" value="<?php echo $email;?>"><br>
            Dirección <input type="text" name="address" value="<?php echo $address;?>"><br>
            Ciudad <input type="text" name="city" value="<?php echo $city;?>"><br>
            Código postal <input type="text" name="zipcode" value="<?php echo $zipcode;?>"><br>
            Provincia <input type="text" name="province" value="<?php echo $province;?>"><br>
            <hr>
            <p id="lopd"></p>
            <hr>
            <p id="underAge"></p>
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>
<script>
    function validate(variable)
    {
        var name, surname, birthdate, dni, lopd;
        if (variable === true) {
            name = document.forms['inscription']['name'].value;
            surname = document.forms['inscription']['surname'].value;
            birthdate = document.forms['inscription']['birthdate'].value;
            dni = document.forms['inscription']['dni'].value;
            lopd = document.forms['inscription']['lopd'].checked;
        }

        if (name === undefined && variable === false) {
            document.getElementById("name").innerHTML='Nombre <span class="error">*</span> <input type="text" id="name" name="name" value=""><br>';
        } else if ((name === undefined && variable === true) || name.trim() == "") {
            var err = "Debe introducir su nombre";
            document.getElementById("name").innerHTML='Nombre <span class="error">*</span> <input type="text" id="name" name="name" value="' + name +' "><span class="error">' + err + '</span><br>';
        }

        if (surname === undefined && variable === false) {
            document.getElementById("surname").innerHTML='Apellidos <span class="error">*</span> <input type="text" id="surname" name="surname" value=""><br>';
        } else if ((surname === undefined && variable === true) || surname.trim() == "") {
            var err = "Debe introducir sus apellidos";
            document.getElementById("surname").innerHTML='Apellidos <span class="error">*</span> <input type="text" id="surname" name="surname" value="' + surname + '"><span class="error">' + err + '</span><br>';
        }

        if (birthdate === undefined && variable === false) {
            document.getElementById("birthdate").innerHTML='Fecha de Nacimiento <span class="error">*</span> <input type="date" id="birthdate" name="birthdate" value="" onchange="underAge(event);"><br>';

        } else if (birthdate === undefined && variable === true) {
            var err = "Debe introducir su fecha de nacimiento";
            document.getElementById("birthdate").innerHTML='Fecha de Nacimiento <span class="error">*</span> <input type="date" id="birthdate" name="birthdate" value="' + birthdate + '" onchange="underAge(event);"> <span class="error">' + err + '</span><br>';
        }

        if (dni === undefined && variable === false) {
            document.getElementById("dni").innerHTML='Dni <span class="error">*</span> <input type="text" id="dni" name="dni" value=""><br>';
        } else if ((dni === undefined && variable === true) || dni.trim() == "") {
            var err = "Debe introducir su número de DNI o NIE";
            document.getElementById("dni").innerHTML='Dni <span class="error">*</span> <input type="text" id="dni" name="dni" value="' + dni + '"><span class="error">' + err + '</span><br>';
        }

        if (lopd === undefined && variable === false) {
            document.getElementById("lopd").innerHTML='Acepto que el Club de Rugby Tres Cantos trate los datos proporcionados con arreglo a la LOPD <input type="checkbox" id="lopd" name="lopd">';
        } else if (lopd === false && variable === true) {
            var err = "Debe aceptar nuestros términos de protección de datos para continuar";
            document.getElementById("lopd").innerHTML='Acepto que el Club de Rugby Tres Cantos trate los datos proporcionados con arreglo a la LOPD <input type="checkbox" id="lopd" name="lopd"><span class="error">' + err + '</span><br>';
        }

        if (variable === true) {
            if (underagePerson === false)  {
                if (validateOverAge() === false) {
                    return false;
                }
            } else {
                under = validateUnderAge();
                par = validateParent();
                if (under === false || par === false) {
                    return false;
                }
            }
            if (lopd === false) {
                return false;
            }
        }
        return true;
    }

    function validateUnderAge()
    {
        if (document.forms['inscription']['dniFront'] === undefined ||
            document.forms['inscription']['dniBack'] === undefined ||
            document.forms['inscription']['familyBook'] === undefined ||
            document.forms['inscription']['healthySystemCard'] === undefined)
            return true;

        dniFrontErr = "", dniBackErr = "", healthySystemCardErr = "", familyBookErr = "";
        dniF = document.forms['inscription']['dniFront'].value;
        dniB = document.forms['inscription']['dniBack'].value;
        familyB = document.forms['inscription']['familyBook'].value;
        healthySystemC = document.forms['inscription']['healthySystemCard'].value;
        if (dniF === undefined || dniF.trim() == "")
            dniFrontErr = "Debe adjuntar DNI del jugador/a o libro de familia y tarjeta sanitaria";
        if (dniB === undefined || dniB.trim() == "")
            dniBackErr = "Debe adjuntar DNI del jugador/a o libro de familia y tarjeta sanitaria";
        if (familyB === undefined || familyB.trim() == "")
            familyBookErr = "Debe adjuntar DNI del jugador/a o libro de familia y tarjeta sanitaria";
        if (healthySystemC === undefined || healthySystemC.trim() == "")
            healthySystemCardErr = "Debe adjuntar DNI del jugador/a o libro de familia y tarjeta sanitaria";
        /*document.getElementById("underAge").innerHTML='DNI delantero <span class="error">**</span> <input type="file" name="dniFront" id="dniFront" accept="image/* /><span class="error">' + dniFrontErr + '</span><br>';
        document.getElementById("underAge").innerHTML+='DNI trasero <span class="error">**</span> <input type="file" name="dniBack" id="dniBack" accept="image/*" /><span class="error">' + dniBackErr + '</span><br>';
        document.getElementById("underAge").innerHTML+='Libro de familia <span class="error">**</span> <input type="file" name="familyBook" id="familyBook" accept="image/*" /><span class="error">' + familyBookErr + '</span><br>';
        document.getElementById("underAge").innerHTML+='Tarjeta sanitaria <span class="error">**</span> <input type="file" name="healthySystemCard" id="healthySystemCard" accept="image/*" /><span class="error">' + healthySystemCardErr + '</span><br>';
        document.getElementById("underAge").innerHTML+='Justificante de pago: <input type="file" name="justificante" id="justificante" accept="image/*" /><br>';
        document.getElementById("underAge").innerHTML+='<span class="error">(**) Es necesario añadir el DNI del jugador o bien libro de familia y tarjeta sanitaria</span><br>';*/
        if (dniFrontErr === "" && dniBackErr === "")
            return true;
        if (familyBookErr === "" && healthySystemCardErr === "")
            return true;
        return false;
    }

    function validateOverAge()
    {
        if (document.forms['inscription']['dniFront'] === undefined ||
            document.forms['inscription']['dniBack'] === undefined)
            return false;

        dniFrontErr = "", dniBackErr = "";
        dniF = document.forms['inscription']['dniFront'].value;
        dniB = document.forms['inscription']['dniBack'].value;
        if (dniF === undefined || dniF.trim() == "")
            dniFrontErr = "Debe adjuntar la parte frontal de su DNI";
        if (dniB === undefined || dniB.trim() == "")
            dniBackErr = "Debe adjuntar la parte posterior de su DNI";
        /*document.getElementById("underAge").innerHTML='DNI delantero <span class="error">**</span> <input type="file" name="dniFront" id="dniFront" accept="image/*" /><span class="error">' + dniFrontErr + '</span><br>';
        document.getElementById("underAge").innerHTML+='DNI trasero <span class="error">**</span> <input type="file" name="dniBack" id="dniBack" accept="image/*" /><span class="error">' + dniBackErr + '</span><br>';
        document.getElementById("underAge").innerHTML+='Justificante de pago: <input type="file" name="justificante" id="justificante" accept="image/*" /><br>';*/
        console.log("dni front: " + dniF);
        console.log("dni back: " + dniB);
        if (dniFrontErr === "" && dniBackErr === "")
            return true;
        return false;
    }

    function validateParent()
    {
        if (document.forms['inscription']['parentName1'] === undefined ||
            document.forms['inscription']['parentSurname1'] === undefined ||
            document.forms['inscription']['parentDni1'] === undefined)
            return false;
            
        parentNameErr = "", parentSurnameErr = "", parentDniErr = "";
        var parentName1 = document.forms['inscription']['parentName1'].value;
        var parentSurname1 = document.forms['inscription']['parentSurname1'].value;
        var parentDni1 = document.forms['inscription']['parentDni1'].value;
        if (parentName1 === undefined || parentName1.trim() == "")
            parentNameErr = "Debe introducir el nombre de al menos un progenitor";
        if (parentSurname1 === undefined || parentSurname1.trim() == "")
            parentSurnameErr = "Debe introducir los apellidos de al menos un progenitor";
        if (parentDni1 === undefined || parentDni1.trim() == "")
            parentDniErr = "Debe introducir el dni de al menos un progenitor";

        document.getElementById("parentData").innerHTML='Nombre del padre/madre <span class="error">*</span> <input type="text" name="parentName1" id="parentName1"> <span class="error">' + parentNameErr + '</span><br>';
        document.getElementById("parentData").innerHTML+='Apellidos del padre/madre <span class="error">*</span> <input type="text" name="parentSurname1" id="parentSurname1"> <span class="error">' + parentSurnameErr + '</span><br>';
        document.getElementById("parentData").innerHTML+='DNI del padre/madre <span class="error">*</span> <input type="text" name="parentDni1" id="parentDni1"> <span class="error">' + parentDniErr + '</span><br><hr>';
        document.getElementById("parentData").innerHTML+='Nombre del padre/madre <input type="text" name="parentName2" id="parentName2"> <br>';
        document.getElementById("parentData").innerHTML+='Apellidos del padre/madre <input type="text" name="parentSurname2" id="parentSurname2"> <br>';
        document.getElementById("parentData").innerHTML+='DNI del padre/madre <input type="text" name="parentDni2" id="parentDni2"> <br><hr>';

        if (parentNameErr === "" && parentSurnameErr === "" && parentDniErr === "")
            return true;
        
        return false;
    }

    validate(false);
</script>
</html>
