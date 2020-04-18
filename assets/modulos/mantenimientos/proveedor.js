var path = "../helados/imgs/";
var app_proveedor={  
    id:'win_proveedor',
        cols:[     
            {
                rows:[
                    {
                        view:'toolbar',
                        cols:[
                            {view:'label',label:'Proveedores'},
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
                                           app.combo('municipiosp',app.urls.municipios+valor_n);
                                        }
                                    }}, 
                                    { view:'select',label:'Municipio',name:'municipio',id:'municipiosp',value:1,options:app.urls.municipios+1,on:{
                                        onChange:function(valor_n1,valor_v1){
                                           //app.combo('coloniasp',app.urls.colonias+valor_n1);
                                        }   
                                    }},
                                ]               
                             },    
                             {
                               cols:[
                                   {view:"multicombo", label:"Productos",name:'id_producto',value:"1",id:'tippropv',options:app.urls.tipoproductos+1}                            
                               ]  
                             },  
                             { view:'text',label:'Plazo',name:'plazo'},                             
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
                             { view:'text',label:'Email',name:'correo',css:'lowercase'},                             
                            {
                               cols:[
                                     {},
                                     { view:"button", type:"imageButton",label:"grabar",	image:path+"save.gif",height:60,width:120,hotkey:'enter',click:function(){
                                        if($$('fproveedor').validate()){
                                                if($$('fproveedor').validate()){
                                                    var data = $$('fproveedor').getValues();
                                                    app.guardar('Proveedores/guardar',data,function(respuesta){
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
                            nombre:webix.rules.isNotEmpty,
                            plazo:plazo
                        },
                    },
                ]
            }
        ],
}
    