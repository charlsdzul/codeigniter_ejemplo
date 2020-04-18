var path = "../sistema/imgs/";
var app_proveedor={
    id:'win_proveedor',
    cols:[
        {
            rows:[
                {
                    view:'toolbar',
                    cols:[
                        {view:'label',label:'Proveedor'},
                        {view:'button',label:'Agregar',type:'icon',icon:'plus-circle',width:100,click:function(){
                            $$('fproveedor').clear();
                            $$('fproveedor').clearValidation();
                            $$('c_form_proveedor').show();
                        }}
                    ]
                },
                {
                  id:'dt_proveedor',
                  view:'datatable',
                  navigation:true,            
                  select:'row',               
                    url:BASE_URL+'index.php/proveedores',
                    columns:[                            
                        {id:'nombre',header:['Nombre',{content:'textFilter'}],fillspace:true},                         
                        {id:'productro',header:['Producto',{content:'textFilter'}],fillspace:true},                         
                    ],
                     on:{
                         onItemDblClick:function(row){
                             var item=this.getItem(row);
                             $$('fproveedor').load(BASE_URL + 'index.php/proveedores/proveedor/'+item.id);
                             $$('c_form_proveedor').show();
                         }
                     }
                },
            ]
        },
        {
            id:'c_form_proveedor',
            hidden:true,
            rows:[
                {
                    view:'toolbar',
                    cols:[
                        {view:'label',label:'Datos Proveedor'}                            
                    ]
                },
                {
                    view:'form',
                    id:'fproveedor',
                    elements:[
                         { view:'text',label:'Nombre',name:'nombre',required:true},
                         {
                            cols:[
                               { view:'select',label:'Estado',name:'estado',value:1,options:app.urls.estados,on:{
                                    onChange:function(valor_n,valor_v){
                                       app.combo('municipios',app.urls.municipios+valor_n);
                                    }
                                }}, 
                                { view:'combo',label:'Municipio',name:'municipio',id:'municipios',value:1,options:app.urls.municipios+1,on:{
                                    onChange:function(valor_n1,valor_v1){
                                       app.combo('colonias',app.urls.colonias+valor_n1);
                                    }   
                                }},                                                                  
                            ]                
                         },    
                         {
                           cols:[
                               {view:"multicombo", label:"Productos",labelWidth:100, value:"1", suggest: "data/names.js",options:[
                                        { id:1, value:"Paleta Agua" },
                                        { id:2, value:"Paleta Leche" },
                                        { id:3, value:"Agua embotellada" }                                    
                               ]}                               
                           ]  
                         },
                         { 
                             rows:[ 
                                { template:"DATOS DE CONTACTO", type:"section"}
                             ]
                         },
                         { 
                             rows:[
                                { view:"text", label:"Nombre",name:'nomcontacto'},
                                { view:"text", label:"Direccion", name:'direccion'},			            
                             ]
                         },                    
                         {
                            cols:[                            
                                { view:'text',label:'Telefono',name:'telefono'},                            
                                { view:'text',label:'Celular',name:'celular'}, 
                            ]                
                         },                   
                         { view:'text',label:'Email',name:'correo',css:'lowercase',width:600},
                         { view:'combo',label:'Colonia',name:'colonia',id:'colonias',value:1,width:600,options:app.urls.ccolonias+1}, 
                         {
                            cols:[
                                {},
                                { view:"button", type:"imageButton",label:"grabar",	image:path+"save.gif",height:60,width:120,click:function(){
                                    if($$('fproveedor').validate()){
                                        if($$('fproveedor').validate()){
                                            var data = $$('fproveedor').getValues();
                                            app.guardar('proveedores/guardar',data,function(respuesta){
                                            respuesta=JSON.parse(respuesta);
                                            if(respuesta.success){
                                                $$('fproveedor').clear();
                                                $$('fproveedor').clearValidation();
                                                app.grid('dt_proveedor','proveedores');
                                                $$('c_form_proveedor').hide();
                                            }                                              
                                            console.log(respuesta);
                                            });
                                        }
                                    }
                                }}, 
                                {view:'button', type:"imageButton",label:'cerrar',	image:path+"undo.gif",height:60,width:120,fillspace:true,click:function(){
                                    $$('c_form_proveedor').hide();
                                }}                  
                            ]
                        },
                        {}
                    ],   
                    elementsConfig:{
                        labelWidth:120
                    },    
                    rules:{
                        nombre:webix.rules.isNotEmpty                    
                    },                                
                }        
            ]
        }
    ],           
}
    
    
        
    
    
 
                
                