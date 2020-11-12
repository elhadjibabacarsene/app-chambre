$(document).ready(function(e){
    $('.addresseclasse').hide();
    $('#statutclass').hide();
    $('.chambreclass').hide();
    $('.typebourseclasse').hide();


    let myNumeroChambreConserver = "";
    myNumeroChambreConserver = $('.mynumerochambre').val();
    let adresseConserver = "";
    adresseConserver = $('.myadresse').val();
    let typeBourseConserver = "";
    typeBourseConserver = $('.myidtypebourse').val();



    $("#categorie2").click(function() {

        $('.addresseclasse').show();
        $('.typebourseclasse').hide();
        $('.chambreclass').hide();
        $('.chambreclass').attr('value', '');
        $('.typebourseclasse').attr('value', '');

        $('.mynumerochambre').val("");
        $('.mynumerochambre').val("");
        $('.myidtypebourse').val("");
        $('.myadresse').val(adresseConserver);

        $(".inshoused").attr("checked",false);

    });
    $("#categorie1").click(function() {

        $('.addresseclasse').hide();
        $('.addresseclasse').attr('value', '');
        $('.typebourseclasse').show();
        $('.chambreclass').show();
        $('.myadresse').val("");
        $('.mynumerochambre').val(myNumeroChambreConserver);
        $('.myidtypebourse').val(typeBourseConserver);

        $(".inshoused").attr("checked",true);
    });


    /****** SI BOURSIER ******/
    if($('.myidtypebourse').val() !== ""){

            $("#categorie1").trigger("click");
    }else{
        $("#categorie2").trigger("click");
        $('.myadresse').val(adresseConserver);
    }


    var prenom_error = false;
    var nom_error = false;
    var email_error = false;
    var datenaissance_error = false;
    var telephone_error = false;
    var typebourse_error = false;
    var numerochambre_error = false;
    var adresse_error = false;

    $(".myprenom").focusout(function() {

        check_prenom();

    });
    $(".mynom").focusout(function() {

        check_nom();

    });
    $(".myemail").focusout(function() {

        check_email();

    });
    $(".mytelephone").focusout(function() {

        check_phone();

    });
    $(".mynumerochambre").focusout(function() {

        check_chambre();

    });

    $(".mydatenaissance").focusout(function() {

        check_datenaissance();

    });
    $(".myidtypebourse").focusout(function() {

        check_typedeBourse();

    });
    $(".myadresse").focusout(function() {

        check_adresse();

    });

    function check_prenom() {

        var prenom_regex = /^[a-zA-Z \-éàè]+$/;
        var prenom_valeur = $('.myprenom').val();

        if (prenom_regex.test(prenom_valeur) && prenom_valeur !== "") {


            $(".myprenom").css("border-bottom", '3px solid #34F458');
            $("#prenom_error").hide();


        } else {

            $("#prenom_error").html("**Prenom invalide");
            $("#prenom_error").show();
            $(".myprenom").css("border-bottom", '3px solid red');
            prenom_error = true;
        }
    }

    function check_nom() {

        var nom_regex = /^[a-zA-Z \-éàè]+$/;
        var nom_valeur = $('.mynom').val();

        if (nom_regex.test(nom_valeur) && nom_valeur !== "") {


            $(".mynom").css("border-bottom", '3px solid #34F458');
            $("#nom_error").hide();


        } else {

            $("#nom_error").html("**Nom invalide");
            $("#nom_error").show();
            $(".mynom").css("border-bottom", '3px solid red');
            nom_error = true;
        }
    }

    function check_email() {
        var email_regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\ .,;:\s@"]+)*)|(" . +"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var email_valeur = $('.myemail').val();

        if (email_regex.test(email_valeur) && email_valeur !== "") {


            $(".myemail").css("border-bottom", '3px solid #34F458');
            $("#email_error").hide();


        } else {

            $("#email_error").html("**Email invalide");
            $("#email_error").show();
            $(".myemail").css("border-bottom", '3px solid red');
            email_error = true;
        }
    }

    function check_phone() {

        var phone_regex = /^7[78065]{1}([-.; ]?[0-9]{2,3}){3}$/;
        var phone_valeur = $('.mytelephone').val();

        if (phone_regex.test(phone_valeur) && phone_valeur !== "") {


            $(".mytelephone").css("border-bottom", '3px solid #34F458');
            $("#telephone_error").hide();


        } else {

            $("#telephone_error").html("**Phone invalide");
            $("#telephone_error").show();
            $(".mytelephone").css("border-bottom", '3px solid red');
            telephone_error = true;
        }
    }


    function check_typedeBourse() {


        var typedeBourse_valeur = $('.myidtypebourse').val();

        if (typedeBourse_valeur !== "") {


            $(".myidtypebourse").css("border-bottom", '3px solid #34F458');
            $("#typebourse_error").hide();


        } else {

            $("#typebourse_error").html("**TypedeBourse invalide");
            $("#typebourse_error").show();
            $(".myidtypebourse").css("border-bottom", '3px solid red');
            typebourse_error = true;
        }
    }

    function check_adresse() {
        var typedeBourse_valeur = $('.myadresse').val();

        if (typedeBourse_valeur !== "") {


            $(".myadresse").css("border-bottom", '3px solid #34F458');
            $("#adresse_error").hide();


        } else {

            $("#adresse_error").html("**Adresse invalide");
            $("#adresse_error").show();
            $(".myadresse").css("border-bottom", '3px solid red');
            typebourse_error = true;
        }

    }

    function check_chambre() {


        var chambre_valeur = $('.mynumerochambre').val();

        if (chambre_valeur !== "") {


            $(".mynumerochambre").css("border-bottom", '3px solid #34F458');
            $("#numerochambre_error").hide();


        } else {

            $("#numerochambre_error").html("**Chambre invalide");
            $("#numerochambre_error").show();
            $(".mynumerochambre").css("border-bottom", '3px solid red');
            numerochambre_error = true;
        }
    }

    $('.mysubmitForm').click(function() {

        prenom_error = false;
        nom_error = false;
        email_error = false;
        telephone_error = false;
        typebourse_error = false;
        numerochambre_error = false;
        adresse_error = false;


        check_prenom();
        check_nom();
        check_email();
        check_chambre();
        check_typedeBourse();
        check_phone();

        if (prenom_error === false && nom_error === false && email_error === false && telephone_error === false && typebourse_error === false && adresse_error === false && numerochambre_error) {

            alert("successful");

            return false;


        } else {

            alert("please Fill the form correctly");


        }
        return false;

    })
})
