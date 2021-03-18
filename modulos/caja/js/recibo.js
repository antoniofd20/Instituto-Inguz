// =====================================
// =========== UN CONCEPTO =============
// =====================================

function ServicioUno(concepto){
    $.ajax({
        url: "busca_servicio.php",
        type: "POST",
        dataType: "json",
        data: {
            concepto: concepto,
        },
    })
    .done(function( data, textStatus, jqXHR ) {
        if ( console && console.log ) {
            //console.log( "La solicitud se ha completado correctamente." );
            $("#clave01").text(data.clave);
            //$("#subtotal01").text(data.monto);
            document.getElementById("monto01").value=data.monto;
            //console.log(data.clave);

            CalculaPrecioUno();
        }
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
        if ( console && console.log ) {
            console.log( "La solicitud a fallado: " +  textStatus);
        }
    })
}

$("#servicio01").change(function(){
    var concepto = $("#servicio01").val();

    // SE EJECUTA LA FUNCION
    ServicioUno(concepto);

})

// Cambiar monto segun cantidad
function CalculaPrecioUno(){
    $("#cantidad01").keyup(function(){
        var cantidad = $("#cantidad01").val();
        var subtotal = $("#monto01").val();

        if(cantidad <= 0){
            var resultado = 0;
        } else {
            var resultado = cantidad * subtotal;
            //resultado = Intl.NumberFormat("en-IN").format(resultado);
        }

        document.getElementById("monto01_2").value=resultado;

        Total();
    })
}

function UnConcepto() {
    // alert("Quieres cobrar un concepto");
    $("#servicio01").show();
    $("#cantidad01").show();
    $("#monto01_2").show();

    $("#servicio02").hide();
    $("#cantidad02").hide();
    $("#monto02_2").hide();

    $("#servicio03").hide();
    $("#cantidad03").hide();
    $("#monto03_2").hide();
}


// =======================================
// =========== DOS CONCEPTOS =============
// =======================================
function ServicioDos(concepto){
    $.ajax({
        url: "busca_servicio.php",
        type: "POST",
        dataType: "json",
        data: {
            concepto: concepto,
        },
    })
    .done(function( data, textStatus, jqXHR ) {
        if ( console && console.log ) {
            // Mostrar clave del concepto
            $("#clave02").text(data.clave);
            
            // Cambiar el valor del inout monto 
            document.getElementById("monto02").value=data.monto;
            //console.log(data.clave);

            CalculaPrecioDos();
        }
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
        if ( console && console.log ) {
            console.log( "La solicitud a fallado: " +  textStatus);
        }
    })
}

$("#servicio02").change(function(){
    var concepto = $("#servicio02").val();

    // SE EJECUTA LA FUNCION
    ServicioDos(concepto);
})

// Cambiar monto segun cantidad
function CalculaPrecioDos(){
    $("#cantidad02").keyup(function(){
        var cantidad = $("#cantidad02").val();
        var subtotal = $("#monto02").val();

        if(cantidad <= 0){
            var resultado = 0;
        } else {
            var resultado = cantidad * subtotal;
            //resultado = Intl.NumberFormat("en-IN").format(resultado);
        }

        document.getElementById("monto02_2").value=resultado;

        Total();
    })
}

function DosConceptos() {
    // alert("Quieres cobrar un concepto");
    $("#servicio01").show();
    $("#cantidad01").show();
    $("#monto01_2").show();

    $("#servicio02").show();
    $("#cantidad02").show();
    $("#monto02_2").show();

    $("#servicio03").hide();
    $("#cantidad03").hide();
    $("#monto03_2").hide();
}


// ========================================
// =========== TRES CONCEPTOS =============
// ========================================
function ServicioTres(concepto){
    $.ajax({
        url: "busca_servicio.php",
        type: "POST",
        dataType: "json",
        data: {
            concepto: concepto,
        },
    })
    .done(function( data, textStatus, jqXHR ) {
        if ( console && console.log ) {
            // Mostrar clave del concepto
            $("#clave03").text(data.clave);
            
            // Cambiar el valor del inout monto 
            document.getElementById("monto03").value=data.monto;
            //console.log(data.clave);

            CalculaPrecioTres();
        }
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
        if ( console && console.log ) {
            console.log( "La solicitud a fallado: " +  textStatus);
        }
    })
}

$("#servicio03").change(function(){
    var concepto = $("#servicio03").val();

    // SE EJECUTA LA FUNCION
    ServicioTres(concepto);
})

// Cambiar monto segun cantidad
function CalculaPrecioTres(){
    $("#cantidad03").keyup(function(){
        var cantidad = $("#cantidad03").val();
        var subtotal = $("#monto03").val();

        if(cantidad <= 0){
            var resultado = 0;
        } else {
            var resultado = cantidad * subtotal;
            //resultado = Intl.NumberFormat("en-IN").format(resultado);
        }

        document.getElementById("monto03_2").value=resultado;

        Total();
    })
}

function TresConceptos() {
    // alert("Quieres cobrar un concepto");
    $("#servicio01").show();
    $("#cantidad01").show();
    $("#monto01_2").show();

    $("#servicio02").show();
    $("#cantidad02").show();
    $("#monto02_2").show();

    $("#servicio03").show();
    $("#cantidad03").show();
    $("#monto03_2").show();
}


// ========================================
// =========== OBTENER TOTAL= =============
// ========================================
function Total(){
    var subtotal1 = $("#monto01_2").val();
    var subtotal2 = $("#monto02_2").val();
    var subtotal3 = $("#monto03_2").val();

    var total = parseFloat(subtotal1) + parseFloat(subtotal2) + parseFloat(subtotal3);

    console.log('Total:' + total);
    total = Intl.NumberFormat("en-IN").format(total);
    document.getElementById("total").value = total;
}