<script>

   function ajaxWebix(){
        webix.ajax().get("../clientes/obtenerClientes", { id:'111111', name : "Charls", last: 'Dzul', estatus:'ACTIVO',rol:'ADMIN' }).then(function(data){
           let res = JSON.parse(data.text())

           //console.dir(res)
            var dato_cliente;

            res.forEach(cliente => {
                dato_cliente = {
                id: cliente[0], 
                usuario: cliente[1] + " " + cliente[2], 
                estatus: cliente[3], 
                rol: cliente[4],
            };

                $$('tablaDatos').add(dato_cliente)                   
            });
        });
   }
                
            var button = {
                    view:"button", 
                    id:"my_button", 
                    value:"Buscar", 
                    css:"webix_primary", 
                    inputWidth:100,
                    click: ajaxWebix
                };       

    var tablaDatos = {
                    view:"datatable",
                    height:600, 
                    id:'tablaDatos',
                    columns:[
                        { id:"id",   header:"ID",   width:100},
                        { id:"usuario",   header:"Usuario",   width:100},
                        { id:"estatus",    header:"Estatus", width:100},
                        { id:"rol",   header:"Rol",        width:100}
                    ] ,
                    data:[
                    /*    { id:11, usuario:'res[0][0]', estatus:'Activo', rol:"Admin"},
                        { id:23, usuario:"Erika A.",    estatus:'Activo', rol:"Operador"},
                        { id:548, usuario:"Dana D.",    estatus:'Inactivo', rol:"Admin"},
                        { id:8, usuario:"Brenda D.",    estatus:'Activo', rol:"Operador"},
                        { id:6565, usuario:"luisa O",   estatus:'Inactivo', rol:"Admin"},
                        { id:12, usuario:"Eli D.",      estatus:'Activo', rol:"Operador"}*/
                    ]
                };

                webix.ui({                    
                    type:"space",
                    rows:[
                        button,
                        tablaDatos
                    ]
                });

</script>