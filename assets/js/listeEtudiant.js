$(document).ready(function(e){

    alletudiant();

    function alletudiant()
    {

        /*let limit = 2;
        let offset = 0;*/

        let url = Routing.generate("alllistetudiant")
        const tbody = $("#list-etudiant");

        $.ajax({
            url:url,
            type:"POST",
            dataType:"Json",
            data:{
                limit:limit,
                offset:offset
            }
        }).done(function(response){
            alert("success");
            console.log(response)
            tbody.html('');
            printTable(response,tbody);
            offset+=2;
        }).fail(function(xhr,status,error,){
            alert("error");
            console.log(xhr);
        })
    }


    function printTable(response,tbody)
    {

        $.each(response,function(key,value){
            let tdBoursier = tdLogier = tdIdchambre = "";
            console.log(value.id);
            //On gère l'affichage dynamique de la colonne boursier
            if(value.idTypeBourse)
            {
                if(value.idTypeBourse === 1){
                    tdBoursier = '<td class="align-middle text-success"><span id="idTypeBourse" typebourse="demi">Oui</span></td>'
                }else if(value.idTypeBourse === 2){
                    tdBoursier = '<td class="align-middle text-success"><span id="idTypeBourse" typebourse="entiere">Oui</span></td>'
                }
            }else{
                tdBoursier = '<td class="align-middle text-danger"><span id="idTypeBourse" typeBourse="non">Non</span></td>';
            }
            if(value.inshoused){
                if(value.inshoused === 1){
                    tdLogier = '<td class="align-middle text-success"><span id="inshoused" inshoused="1">Oui</span></td>'
                }else{
                    tdLogier = '<td class="align-middle text-danger"><span id="inshoused" inshoused="0">Non</span></td>'
                }
            }else{
                tdLogier = '<td class="align-middle text-danger"><span id="inshoused" inshoused="0">Non</span></td>'
            }
            if(value.numeroChambre){
                tdNumeroChambre = '<td class="align-middle"><span id="numeroChambre">'+value.numeroChambre+'</span></td>'
            }else{
                tdNumeroChambre = '<td class="align-middle"><span id="numeroChambre">---</span></td>'
            }

            tbody.append(`
                <tr id="list_table" idEtudiant="${value.id}">
                    <td class="align-middle"><span id="matricule">${value.matricule}</span></td>
                    <td class="align-middle"><span id="prenom">${value.prenom}</span></td>
                    <td class="align-middle"><span id="nom">${value.nom}</span></td>
                    ${tdBoursier}
                    ${tdLogier}
                    ${tdNumeroChambre}
                    <td id=""><button class="btn btn-danger"><span class="fa fa-archive"></span></button></td>
                </tr>
            `);
        })
    }

})


