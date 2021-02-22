<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/dist/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="icon" href="images/icon/icon.png">
    <script type="text/javascript" src="js/api.js"></script>
    <script type="text/javascript" src="js/editaPerfil.js"></script>
    <script src="js/closeSesion.js"></script>
    <title>Edita perfil</title>
</head>

<?php
include_once 'navBar.php';
?>

<body>

    <div class="container" id="perfilContainer">
        <div class="card" id="perfilCard">
            <div>
                <div class="wrapper row">
                    <div class="col-md-6">
                        <div class="nav" id="images">
                            <div class="row" id="bigPic">
                            </div>
                            <div class="row" id="smallPics">
                            </div>
                        </div>
                    </div>
                    <div class="details col-md-6">
                        <div class="establiment-title-div">
                            <h3 class="establiment-nom" id="nomEstabliment"></h3>
                            <button id="edita-nom" data-toggle="modal" data-target="#modalEditaNom" class="editClick btn btn-link p-0 m-0 d-inline align-baseline">Edita nom</button>
                        </div>
                        <br>
                        <div class="establiment-description-div">
                            <p class="establiment-descripcio" id="descripcioEstabliment"></p>
                            <button id="edita-description" data-toggle="modal" data-target="#modalEditaDescripcio" class="editClick btn btn-link p-0 m-0 d-inline align-baseline">Edita descripcio</button>
                        </div>
                        <br>
                        <div class="action">
                            <button class="add-to-cart btn float-right realBtn" data-toggle="modal" data-target="#modalEditaPerfil" type="button" id="edita-perfil" style="margin-right: 10px">Edita perfil</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Edita nom -->
    <div id="modalEditaNom" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- header modal -->

                <div class="modal-header justify-content-center">
                    <h4 class="modal-title" id="exampleModalLabel">Edita nom de l'establiment</h4>
                </div>

                <!-- body modal -->
                <div class="modal-body">
                    <form role="form" name="formEdita" action="edita.php" method="get">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <label>Nom:</label>
                                <input id="input-nom" type="text" class="form-control" name="nom">
                            </div>
                        </div>
                    </form>
                </div>

                <!-- footer modal -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
                    <button id="bEditaNom" type="button" class="btn realBtn" data-dismiss="modal">Guardar</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal Edita Descripció -->
    <div id="modalEditaDescripcio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <!-- header modal -->

                <div class="modal-header justify-content-center">
                    <h5 class="modal-title" id="exampleModalLabel">Edita descripció de l'establiment</h5>
                </div>


                <!-- body modal -->


                <div class="modal-body">
                    <form role="form" name="formEdita" action="edita.php" method="get">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <label>Descripció:</label>
                                <textarea id="input-descripcio" type="text" class="form-control" name="descripcio"></textarea>
                            </div>
                        </div>
                    </form>
                </div>


                <!-- footer modal -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
                    <button id="bEditaDescripcio" type="button" class="btn realBtn" data-dismiss="modal">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edita Perfil -->
    <div id="modalEditaPerfil" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <!-- header modal -->

                <div class="modal-header justify-content-center">
                    <h5 class="modal-title" id="exampleModalLabel">Edita establiment</h5>
                </div>


                <!-- body modal -->


                <div class="modal-body">
                    <form role="form" name="formEdita" action="edita.php" method="get">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <label>Localitat:</label>
                                <select name="localitat" id="localitat" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Telefon:</label>
                                <input name="telefon" id="telefon" class="form-control">

                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Correu electrònic:</label>
                                <input type="email" name="correu_electronic" id="correu_electronic" class="form-control"></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nombre de comensals:</label>
                                <input type="number" id="nComensals" name="nComensals" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span>Especialitats:</span>
                                <div id="especialitats">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


                <!-- footer modal -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
                    <button id="bEditaPerfil" type="button" class="btn realBtn" data-dismiss="modal">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
include_once 'footer.php';
?>

</html>