//On récupère le select
$(document).ready(function(e){


    const selectElement = $("#add_chambre_idBatiment");
    const numChambre = $("#add_chambre_numero");
    numChambre.addClass('disable');

    selectElement.change(function(e){
        let idBatiment = selectElement.val();
        let url = Routing.generate("generernumerochambre");

        $.ajax({
            type:"POST",
            url:url,
            dataType:"json",
            data:{
                value:idBatiment
            }
        }).done(function(response){
            numChambre.attr("value",response);
        }).fail(function(xhr,status,error,){
            alert("error");
            console.log(xhr);
        })
    })
})
