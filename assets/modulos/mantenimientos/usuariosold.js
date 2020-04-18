var path = "../sistema/imgs/";
var app_usuarios={    
    id:'wusuarios',
    view:'window',
    //hidden:false,
    modal:true,
    width:1200,
    height:800,
    position:'center',
    head:'USUARIOS',
    body:{        
        rows:[           
            {                             
               view:'form',
               id:'fusuarios',
               elements:[
                    {
                       cols:[
                            {view:'select',name:'plaza',label:'Plaza',id:'plaza',value:1,width:400,options:app.urls.plazas},
                            {view:'text',name:'nombre',label:'Nombre',required:true}                            
                       ]                       
                    },
                    {
                       cols:[
                            {view:'select',name:'tipousr',label:'Tipo de Usuario',id:'tipousr',value:1,width:300,labelWidth:150,options:app.urls.tipousr},
                            {view:'text',name:'usuario',label:'Usuario',required:true},
                            {view:'text',name:'clave',label:'Clave',type:'password',required:true},
                            {view:'text',name:'confirmar',label:'Confirmar Clave',type:'password',labelWidth:150,required:true,invalidMessage:'Las contrasenas no coinciden'}
                       ]    
                    },
                    {
                       cols:[
                             {},
                             { view:"button", type:"imageButton",label:"grabar",	image:path+"save.gif",height:60,width:120,hotkey:'enter',click:function(){
                                if($$('fusuarios').validate()){
                                        if($$('fusuarios').validate()){
                                            var data = $$('fusuarios').getValues();
                                            app.guardar('Usuarios/guardar',data,function(respuesta){
                                            respuesta=JSON.parse(respuesta);
                                            if(respuesta.success){
                                                $$('fusuarios').clear();
                                                $$('fusuarios').clearValidation();
                                                $$('wusuarios').hide();
                                            }                                              
                                            console.log(respuesta);
                                            });
                                        }
                                }
                             }}, 
                             {view:'button', type:"imageButton",label:'cerrar',	image:path+"undo.gif",height:60,width:120,fillspace:true,click:function(){
                                    $$('wusuarios').hide();
                             }}
                       ]
                    }                
                ],
                rules:{
                    /* telefono:webix.rules.isNumber*/
                    usuario:webix.rules.isNotEmpty,                    
                    clave:oclave,
                    $obj:function(data){
                        /*console.log(data);*/
                        return(data.confirmar==data.clave);
                    }                    
                },
            }
        ]
    },
}
    


webix.ready(function(){
   webix.ui(app_usuarios); 
    });