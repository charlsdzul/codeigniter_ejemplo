var path = "../sistema/imgs/";
var app_empleados={
    id:'wempleados',
    view:'window',
    head:'EMPLEADOS',
    //hidden:false,
    modal:true,
    width:1200,
    height:800,
    position:'center',
    body:{
        rows:[           
            { 
               view:'form',
               id:'fempleados',
               elements:[
                    {
                       cols:[
                            {view:'select',name:'plaza',label:'Plaza',id:'plazas',value:1,width:400,options:app.urls.plazas+1},
                            {view:'select',name:'puesto',id:'puesto',label:'Puesto del Empleado',value:1,width:450,labelWidth:200,options:app.urls.tipousr+1},
                            {view:'text',name:'rfc',label:'RFC'},
                       ]                       
                    },
                    {
                       cols:[
                            {view:'text',name:'nombre',label:'Nombre',width:500},                            
                            {view:'text',name:'apepat',label:'Paterno'},                            
                            {view:'text',name:'apemat',label:'Materno'},
                       ]    
                    },
                    {
                       cols:[
                            {view:'text',name:'tiposangre',label:'Tipo de Sangre',width:200,labelWidth:120},                            
                            {view:'text',name:'telefono',label:'Telefono'},                            
                            {view:'text',name:'celular',label:'Celular'},                      
                       ]    
                    },
                    {
                       cols:[                            
                            {view:'text',name:'correo',label:'Correo',width:500},
                            {view:'text',name:'curp',label:'CURP',width:300},
                            {view:'text',name:'nss',label:'NSS',width:300},
                       ]    
                    },
                    {
                       cols:[
                             {},
                             { view:"button", type:"imageButton",label:"grabar",	image:path+"save.gif",height:60,width:120,hotkey:'enter',click:function(){
                                if($$('fempleados').validate()){
                                var data = $$('fempleados').getValues();
                                app.guardar('Empleados/guardar',data,function(respuesta){
                                    respuesta=JSON.parse(respuesta);
                                    if(respuesta.success){
                                        $$('fempleados').clear();
                                        $$('fempleados').clearValidation();
                                        $$('wempleados').hide();
                                    }
                                    console.log(respuesta);
                                });                      
                                }
                             }}, 
                             {view:'button', type:"imageButton",label:'cerrar',	image:path+"undo.gif",height:60,width:120,fillspace:true,click:function(){
                                    $$('wempleados').hide();
                             }}
                       ]
                    }                
                ],
                rules:{
                    /* telefono:webix.rules.isNumber*/
                    nombre:webix.rules.isNotEmpty,                     
                    apepat:webix.rules.isNotEmpty,                     
                    apemat:webix.rules.isNotEmpty,                     
                },
            }
        ]
    },
}
    


webix.ready(function(){
   webix.ui(app_empleados); 
    
});