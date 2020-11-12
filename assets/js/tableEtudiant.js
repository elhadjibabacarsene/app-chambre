$(document).ready(function(e){


    let url = Routing.generate("alllistetudiant");

    $("#table-list-etudiant").DataTable({
        scrollY : "400px",
        scrollCollapse : true,
        paging : false,
        ajax:{
            url:url,
            type:"POST",
            dataType:"json",
            dataSrc: ""
        },
        columns:[
            {data:"matricule"},
            {data:"prenom"},
            {data:"nom"},
            {
                data:"idTypeBourse",
                render:function(data,type){
                    var typeBourse = "";
                    if(data){
                        typeBourse = data.libelle;
                    }else{
                        typeBourse = "Non-boursier"
                    }
                    return typeBourse;
                },
            },
            {
                data:"inshoused",
                render: function (data,type) {
                    let inshoused = "";
                    if(data!==null && data===true){
                        inshoused = "Logier"
                    }else{
                        inshoused = "Non-logier"
                    }
                    return inshoused;
                }
                },
            {
                data:"numeroChambre",
                render:function(data,type){
                    let numeroChambre = "";
                    if(data){
                        numeroChambre = data.numero
                    }else{
                        numeroChambre = "---"
                    }
                    return numeroChambre;
                }
            },
            {
                data:"id",
                render(data,type,row){
                    return '<a href="/etudiant/'+data+'/edit" id="update" class="data"><span class="fa fa-pencil"></span></a>';
                }
            },
            {
                data:"id",
                render(data,type,row){
                    return '<a href="etudiant/'+data+'/delete" id="delete" class="data"><span class="fa fa-archive"></span></a>';
            }
            }
        ]
    });


})