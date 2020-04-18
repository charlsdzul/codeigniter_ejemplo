<script>
    
                var menu = {
                    view:"menu",
                    autowidth:true,
                    data:[
                      
                        { id:"2",value:"Clientes", href:'clientes'},
                        { id:"3",value:"Alta Cliente",href:'clientesAlta'},
                        { id:"4",value:"Login",href:'login'},
                        { id:"5",value:"Logout",href:'logout'}
                    ],
                    type:{
                        subsign:true
                    },
                } ;

                webix.ui({                    
                    type:"space",
                    rows:[
                    menu
                    ]
                });

</script>