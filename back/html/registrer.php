<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <!-- Script per validar -->
    <script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.0/dist/bootstrap-validate.js"></script>

</head>

<body>

    <div class="container">
        <h2>Registre</h2>
        <form method="POST" action="https://api.restaurat.me/controller/establiment/addEstabliment.php">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Restaurant</label>
                    <input id="nom" class="form-control" name="establiment" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Email</label>
                    <input id="email" class="form-control" name="email" type="email" required>
                </div>
                <div class="form-group col-md-4">
                    <label>Nombre màxim de comensals</label>
                    <input id="comensals" class="form-control" name="numComensals" type="number" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">Localitat</label>
                    <select id="poblacio" class="form-control" name="poblacio" required>
              <option selected>Selecciona</option>
            </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Telèfon</label>
                    <input id="tlfn" class="form-control" name="tel" required>
                </div>
                <div class="form-group col-md-12" id="checkBox">
                    <label>Especialització  </label>
                </div>
                <div class="form-group col-md-6">
                    <label>Contrasenya</label>
                    <input id="pswd" type="password" class="form-control" name="paswd" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Repeteix contrasenya</label>
                    <input id="pswdR" type="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Registrar-se</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {

            function loadPoblacio() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var poblacio = JSON.parse(this.responseText);
                        for (c in poblacio) {
                            var idPoblacio = poblacio[c].id;
                            var nom = poblacio[c].nom;
                            var item = $("<option/>", {
                                value: idPoblacio,
                                text: nom
                            });
                            $("#poblacio").append(item);
                        }
                    }
                };
                xhttp.open("GET", "https://api.restaurat.me/controller/poblacio/poblacio.php", true);
                xhttp.send();
            }

            function loadCategoria() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var categoria = JSON.parse(this.responseText);
                        for (c in categoria) {
                            var idCat = categoria[c].id;
                            var nom = categoria[c].nom;
                            var div = $('<div/>', {
                                class: "form-check form-check-inline"
                            });
                            var item = $("<input>", {
                                class: "form-check-input",
                                type: 'checkbox',
                                name: 'id[]',
                                value: idCat
                            });
                            var label = $('<label/>', {
                                class: "form-check-label",
                                text: nom
                            });
                            div.append(item, label);
                            $("#checkBox").append(div);


                        }
                    }
                };
                xhttp.open("GET","https://api.restaurat.me/controller/categoria/categoria.php", true);
                xhttp.send();
            }

            loadPoblacio();
            loadCategoria();
            bootstrapValidate('#nom', 'required:Aquest camp es obligatori!');
            bootstrapValidate('#email', 'required:email:Enter a valid E-Mail Address!');
            bootstrapValidate('#comensals', 'numeric:Caracter no valid');
            bootstrapValidate('#poblacio', 'required:Aquest camp es obligatori!');
            bootstrapValidate('#tlfn', 'numeric:Caracter no valid');
            bootstrapValidate('#pswd', 'Les contrasenyes han de coincidir!');
            bootstrapValidate('#pswdR', 'matches:#pswd:Les contrasenyes han de coincidir!');

        });
    </script>
<?
include("footer.php");
?>
</body>

</html>