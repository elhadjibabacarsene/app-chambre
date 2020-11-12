$(document).ready(function(e){

    let url = Routing.generate("alllistchambre");

    $("#table-list-chambre").DataTable({
        scrollY : "200px",
        scrollCollapse : true,
        paging : false,
        ajax:{
            url:url,
            type:"POST",
            dataSrc:"",
            dataType:"json"
        },
        columns:[
            {data:"numero"},
            {
                data:"idTypeChambre",
                render:function(data,type){
                    return data.libelle
                }
            },
            {
                data:"idBatiment",
                render:function(data,type){
                    return data.numero
                }
            },
            {
                data:"id",
                render(data,type,row){
                    return '<a href="/chambre/'+data+'/edit" id="update" class="data"><span class="fa fa-pencil"></span></a>';
                }
            },
            {
                data:"id",
                render(data,type,row){
                    return '<a href="/chambre/'+data+'/delete" id="delete" class="data"><span class="fa fa-archive"></span></a>';
                }
            }
        ]
    })

})