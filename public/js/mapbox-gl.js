function mostrarCamposAdicionales(tipo) {
    var presencialFields = document.getElementById("presencialFields");
    var virtualFields = document.getElementById("virtualFields");

    if (tipo === "presencial") {
        presencialFields.style.display = "block";
        virtualFields.style.display = "none";
    }

    else if (tipo === "virtual") {
        presencialFields.style.display = "none";
        virtualFields.style.display = "block";
    }

    else {
        presencialFields.style.display = "none";
        virtualFields.style.display = "none";
    }
}