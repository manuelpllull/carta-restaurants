<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="js/api.js"></script>
    <script src="js/editaCarta.js"></script>
    <script src="js/closeSesion.js"></script>
    <link rel="stylesheet" href="/css/dist/style.css">
    <link rel="stylesheet" href="/css/dist/cartaSeccio.css">


    <title>Carta i Selecció de Seccions</title>
</head>

<?php
include_once 'navBar.php';
?>

<body>
    <div class="container">
        <div class="modal fade" id="modal1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100">Editar nom secció</h4>
                    </div>
                    <div class="modal-body">
                        <form method="GET">
                            <input type="hidden" name="idSeccio" id="idSeccioForm">
                            <div class="row">
                                <div class="col-12">
                                    <label for="nomSeccioForm">Nom secció:</label><br>
                                    <input type="text" name="nomSeccio" id="nomSeccioForm">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Tanca</button>
                        <button type="button" class="btn nomModal" data-dismiss="modal">Desa</button>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="modal2" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100">Afegir carta</h4>
                    </div>
                    <div class="modal-body">
                        <form method="GET">
                            <div class="row">
                                <div class="col-12"><label for="nomCartaForm">Nom carta: </label><br>
                                    <input type="text" name="nomCarta" id="nomCartaForm">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Tanca</button>
                        <button type="button" class="btn" id="bAfegirCarta" data-dismiss="modal">Afegir</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal3" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100">Afegir secció</h4>
                    </div>
                    <div class="modal-body">
                        <form method="GET">
                            <div class="row">
                                <div class="col-12">
                                    <label for="nomS">Nom secció: </label><br>
                                    <input type="text" name="nomSeccio" id="nomS">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Tanca</button>
                        <button type="button" class="btn" id="bAfegir" data-dismiss="modal">Desa</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal4" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100">Editar nom carta</h4>
                    </div>
                    <div class="modal-body">
                        <form method="GET">
                            <input type="hidden" name="idSeccio" id="idCartaForm">
                            <div class="row">
                                <div class="col-12">
                                    <label for="nomC">Nom carta: </label><br>
                                    <input type="text" name="nomCarta" id="nomC">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Tanca</button>
                        <button type="button" class="btn bModificarCarta" data-dismiss="modal">Desa</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal5" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100">Estàs segur que vols eliminar la carta?</h4>
                    </div>
                    <div class="modal-body">
                        <button type="button" class="btn" data-dismiss="modal">Cancel·la</button>
                        <button type="button" class="btn" id="esborrarCarta" data-dismiss="modal">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal6" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100">Estàs segur que vols eliminar la secció?</h4>
                    </div>
                    <div class="modal-body">
                        <button type="button" class="btn" data-dismiss="modal">Cancel·la</button>
                        <button type="button" class="btn" id="esborrarSeccio" data-dismiss="modal">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1 id="cartesh1">Cartes</h1>
                </div>
                <div class="col-md-4">
                    <button type="button" id="afegirCarta" class="btn float-right mt-2">Afegir carta</button>
                </div>
            </div>
            <div id="cartes"></div>
            <hr>
            <div id="seccions"></div>
        </div>
    </div>

</body>

<?php
include_once 'footer.php';
?>

</html>