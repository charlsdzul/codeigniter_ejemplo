var path = "../sistema/imgs/";
var app_usuarios={
    id:'win_usuarios',
        cols:[     
            {
                rows:[
                    {
                        view:'toolbar',
                        cols:[
                            {view:'label',label:'Usuarios'},
                            {view:'button',label:'Agregar',type:'icon',icon:'plus-circle',width:100,click:function(){
                                $$('fusuarios').clear();
                                $$('fusuarios').clearValidation();
                                $$('c_form_usuario').show();
                            }}
                        ]
                    },
                    {
                      id:'dt_usuarios',
                      view:'datatable',
                      navigation:true,            
                      select:'row',               
                        url:BASE_URL+'index.php/usuarios',
                        columns:[                            
                            {id:'usuario',header:['Usuario',{content:'textFilter'}],fillspace:true},                         
                            {id:'nombre',header:['Nombre',{content:'textFilter'}],fillspace:true},                         
                        ],
                         on:{
                             onItemDblClick:function(row){
                                 var item=this.getItem(row);
                                 $$('fusuarios').load(BASE_URL + 'index.php/usuarios/usuario/'+item.id);
                                 $$('c_form_usuario').show();
                             }
                         }
                    },
                ]
            },
            {
                id:'c_form_usuario',
                hidden:true,
                rows:[
                    {
                        view:'toolbar',
                        cols:[
                            {view:'label',label:'Datos Usuarios'}                            
                        ]
                    },
                    {                             
                       view:'form',
                       id:'fusuarios',
                       elements:[
                                    {view:'select',name:'plaza',label:'Plaza',id:'plaza',value:1,options:app.urls.plazas},
                                    {view:'text',name:'nombre',label:'Nombre',required:true},
                                    {view:'select',name:'tipousr',label:'Tipo de Usuario',id:'tipousr',value:1,options:app.urls.tipousr},
                                    {view:'text',name:'usuario',label:'Usuario',required:true},
                                    {view:'text',name:'clave',label:'Clave',type:'password',required:true,invalidMessage:'La contrasena incorrecta o menor a 8 digitos'},
                                    {view:'text',name:'confirmar',label:'Confirmar Clave',type:'password',required:true,invalidMessage:'Las contrasenas no coinciden'},

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
                                                        app.grid('dt_usuarios','usuarios');
                                                        $$('c_form_usuario').hide();
                                                    }                                              
                                                    console.log(respuesta);
                                                    });
                                                }
                                        }
                                     }}, 
                                     {view:'button', type:"imageButton",label:'cerrar',	image:path+"undo.gif",height:60,width:120,fillspace:true,click:function(){
                                            $$('c_form_usuario').hide();
                                     }}
                               ]
                            },
                           {}
                        ],
                        elementsConfig:{
                            labelWidth:140
                        },
                        rules:{
                            /* telefono:webix.rules.isNumber*/
                            usuario:webix.rules.isNotEmpty,                    
                            clave:oclave,
                            $obj:function(data){
                                /*console.log(data);*/
                                return(data.confirmar==data.clave);
                            }                    
                        },
                    },
                ]
            }
        ],
}