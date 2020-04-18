webix.ready(function(){
   webix.ui({
    view:'window',
    position:"center",
    head:'Acceso a Usuarios',
    hidden:false,
    id:"log_form",   
    body:{   
        view:'form',
        id:'flogin',        
        elements:[        
        { view:"text", label:'Usuario', name:"usuario", invalidMessage: "Usuario Incorrecto" },
		{ view:"text", label:'Clave', name:"clave", type:'password',invalidMessage: "Clave Incorrecta" },        
        { margin:5, cols:[
            { view:"button", value:"Ingresar" , type:"form",hotkey:'enter',click:function(){
               if($$('flogin').validate()){
                  var data = $$('flogin').getValues();
                   webix.ajax().post(BASE_URL + 'index.php/welcome/dologin',data,function(respuesta){
                       respuesta= JSON.parse(respuesta);
                       if(respuesta.status===true){
                           document.location=BASE_URL;
                       }else{
                           webix.alert('Usuario o Contraseña invalido');
                       }
                   });
                  console.log(data);                 
               }
            }},
            { view:"button", value:"Cancelar" }
        ]},
        {template:'<a href="http://pixxels.com.mx" target="_blank">Desarrollo pixxels.com.mx</a>',height:20}
        ],
        rules:{
				usuario: webix.rules.isNotEmpty,
				clave: webix.rules.isNotEmpty
              }
    }
   });    
});