$(document).ready(function() {
    var establiment;
    var poblacions;
    var categories;
    getEstabliment(1);
    getPoblacions();
    getCategoriesFromDB();


    //Update profile functions
    function updateNom() {
        var pobId = getPoblacioId();
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {}
        }
        xhttp.open("POST", api + "/establiment/updateNom.php?id=" + establiment.id +
            "&nom=" + $("#input-nom").text(), true);
        xhttp.send();
    }

    function updateDescripcio() {
        var pobId = getPoblacioId();
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {}
        }
        xhttp.open("POST", api + "/establiment/updateDescripcio.php?id=" + establiment.id +
            "&descripcio=" + $("#input-descripcio").text(), true);
        xhttp.send();
    }

    function updateCategories() {
        var categories = getCategories();
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {}
        }
        for (var i = 0; i < categories.length; i++) {
            xhttp.open("POST", api + "/establiment_categoria/insert.php?Establiment_id=" + establiment.id +
                "&CategoriaId=" + categories[i], true);
            xhttp.send();
        }
    }

    function deleteCategories() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {}
        }
        xhttp.open("POST", api + "/establiment_categoria/delete.php?Establiment_id=" + establiment.id, true);
        xhttp.send();
    }


    function updateOthers() {
        var pobId = getPoblacioId();
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {}
        }
        xhttp.open("POST", api + "/establiment/updateOthers.php?id =" + establiment.id +
            "&correu_electronic =" + $("#corrreu_electronic").text() + "&num_comensals =" + $("#nComensals") +
            "&telefon =" + $("#telefon") + "&poblacio_id =" + $("#localitat").find(":selected").attr('id').replace("poblacio", ""), true);
        xhttp.send();
    }


    function editaPerfil() {
        deleteCategories();
        updateCategories();
        updateOthers();
    }

    function getPoblacioId() {
        var optionId = $("#localitat").children("option:selected").attr("id");
        optionId = optionId.replace("poblacio", '');
        return optionId;
    }

    function getCategories() {
        var checkedboxes = new Array();
        for (var i = 1; i < categories.length + 1; i++) {
            var checkbox = $("#boxCateg" + i);
            var checkboxId = checkbox.attr("id").replace("boxCateg", "");
            if (checkbox.attr("checked")) {
                checkedboxes.push(checkboxId);
            }
        }
        return checkedboxes;
    }


    //Inicializer functions

    function getEstabliment() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                establiment = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", api + "/establiment/readById.php", false);
        xhttp.send();
    }

    function getPoblacions() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                poblacions = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", api + "/poblacio/read.php", false);
        xhttp.send();
    }

    function getCategoriesFromDB() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                categories = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", api + "/categoria/read.php", false);
        xhttp.send();
    }

    function placeEstablimentVars() {
        $("#nomEstabliment").text(establiment.nom);
        for (var i = 1; i <= 5; i++) {
            var img = $("<img/>");
            img.attr("id", "pic" + i);
            img.attr(
                "src",
                "../images/establiment/" + establiment.id + "-" + i + ".jpg"
            );
            img.attr("alt", "Restaurant Image");
            if (i != 1) {
                img.addClass("col-md-3 col-sm-6");
                $("#smallPics").append(img);
            } else {
                img.addClass("col");
                $("#bigPic").append(img);
            }
        }

        $("#descripcioEstabliment").text(establiment.descripcio);
        $("#input-nom").val(establiment.nom);
        $("#input-descripcio").val(establiment.descripcio);
        $("#nComensals").val(establiment.num_comensals);
        $("#correu_electronic").val(establiment.correu_electronic);
        $("#telefon").val(establiment.telefon);

        for (var i = 0; i < poblacions.length; i++) {
            var option = $("<option/>", {
                value: poblacions[i].nom,
                id: "poblacio" + poblacions[i].id,
            });
            option.html(poblacions[i].nom);
            $("#localitat").append(option);
        }


        for (var i = 0; i < categories.length; i++) {
            var label = $("<label/>", { for: "boxCateg" + categories[i].id });
            label.html(categories[i].nom);
            var checkbox = $("<input/>", {
                type: "checkbox",
                id: "boxCateg" + categories[i].id,
                name: "boxCateg" + categories[i].id,
                value: categories[i].id,
                class: "checkbox"
            });

            for (var j = 0; j < establiment.categories.length; j++) {
                if (categories[i].id == establiment.categories[j]) {
                    checkbox.attr("checked", "yes");
                }
            }


            $("#especialitats").append(checkbox, label, "<br>");
        }

    }

    //Execution
    placeEstablimentVars();
    $("#bEditaNom").on("click", updateNom());
    $("#bEditaDescripcio").on("click", updateDescripcio());
    $("#bEditaPerfil").on("click", editaPerfil());
});