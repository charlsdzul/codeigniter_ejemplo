<script>

 function altaCliente(){

    var form_usuario = $$('formAlta').getValues().usuario;
    var form_contrasena = $$('formAlta').getValues().contrasena;


    webix.ajax()
    .post("../clientes/login",{usuario:form_usuario, contrasena:form_contrasena})
    .then(function(data){
        let res = data.text()       
       
       if(res=='00'){           
        console.log(res)      
        window.location.href = "clientes";
        redirect('clientes');  

       }else{
        webix.alert('Usuario y/o contraseña inválida: '+res,"alert-warning"); 
       }


    })




 }




webix.ui({  
  	view:"form",
      id: 'formAlta',
    scroll:false,
  	width:300,
  	elements:[
        { view:"text", label:"Usuario", name:'usuario'},
        { view:"text", label:"Contrseña", name:'contrasena', type:'password'},
        { margin:5, cols:[
            { view:"button", click:'altaCliente', label:"Alta" , type:"form" }
        
        ]}
  	]
});

</script>