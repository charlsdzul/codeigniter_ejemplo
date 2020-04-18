<script>

 function altaCliente(){

    var form_name = $$('formAlta').getValues().nombre;
    var form_last = $$('formAlta').getValues().apellido;
    var form_estatus = $$('formAlta').getValues().estatus;
    var form_rol = $$('formAlta').getValues().rol;

   // console.log(form_name);

    webix.ajax()
    .post("../clientes/altaClientes",{name:form_name, last:form_last, estatus:form_estatus, rol:form_rol})
    .then(function(data){
        let res = data.text()
       
       if(res=='00'){             
        webix.alert('ALTA EXITOSA',"alert-warning");

       }else{
        webix.alert('ALTA NO EXITOSA',"alert-warning"); 
       }


    })




 }




webix.ui({  
  	view:"form",
      id: 'formAlta',
    scroll:false,
  	width:300,
  	elements:[
        { view:"text", label:"Nombre", name:'nombre'},

        { view:"text", label:"Apellido", name:'apellido'},

        { view:"select", label:"Estatus", name:'estatus',options:[
            {id:'ACTIVO', value:'ACTIVO'},
            {id:'INACTIVO', value:'INACTIVO'}
        ]},

        { view:"select", label:"Rol", name:'rol',options: [
          {id:'ADMIN', value:'ADMIN'},
          {id:'USER', value:'USER'}
        ]},

        { margin:5, cols:[
            { view:"button", click:'altaCliente', label:"Alta" , type:"form" }
        
        ]}
  	]
});

</script>