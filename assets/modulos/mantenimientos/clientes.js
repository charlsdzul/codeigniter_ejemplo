var path = "../sistema/imgs/";
var app_clientes={
    id:'win_clientes', 
    cols:[
        {
            rows:[
                {
                  view:'toolbar',
                    cols:[
                        {view:'label',label:'Clientes'},
                        {view:'button',label:'Agregar',type:'icon',icon:'plus-circle',width:100,click:function(){
                            $$('fclientes').clear();
                            $$('fclientes').clearValidation();
                            $$('c_form_clientes').show();
                        }}
                    ]   
                },
                {
                  id:'dt_clientes',
                      view:'datatable',
                      navigation:true,            
                      select:'row',               
                        url:BASE_URL+'index.php/clientes',
                        columns:[                           
                            /*{id:'id',header:'Cuenta', css:"rank",	sort:"int",
                                footer:{text:"Total:", colspan:4}
                            },*/
                            {id:'id',header:'Cuenta'},                            
                            {id:'nombres',header:['Nombres',{content:'textFilter'}],fillspace:true},                         
                            {id:'apepat',header:['Paterno',{content:'textFilter'}],fillspace:true},                         
                            {id:'apemat',header:['Materno',{content:'textFilter'}],fillspace:true},                         
                            {id:'saldo',header:['Saldo',{content:'selectFilter'}],fillspace:true,
                                css:'t_right', 
                                format:webix.Number.numToStr({
                                        groupDelimiter:",",
                                        groupSize:3,
                                        decimalDelimiter:".",
                                        decimalSize:2
                                })
                            }                                                    
                        ],                        
                         on:{
                             onItemDblClick:function(row){
                                 var item=this.getItem(row);
                                 $$('fclientes').load(BASE_URL + 'index.php/clientes/cliente/'+item.id);
                                 $$('c_form_clientes').show();
                             }
                         }  
                },
            ]   
        },
        {
            id:'c_form_clientes',
            hidden:true,
            rows:[
                {
                    view:'toolbar',
                    cols:[
                        {view:'label',label:'Datos del Cliente'}                            
                    ]    
                },
                {
                    view:'form',
                    id:'fclientes',
                    elements:[
                         {
                            cols:[
                               { view:'text',label:'Nombre',name:'nombres',required:true},
                               { view:'text',label:'Paterno',name:'apepat'},
                               { view:'text',label:'Materno',name:'apemat',fillspace:true},                                  
                            ]                
                         },
                         {
                            cols:[
                                { view:'text',label:'Telefono',name:'telefono',labelWidth:100},
                                { view:'text',label:'Celular',name:'celular'},
                                { view:'text',label:'Nextel',name:'nextel',fillspace:true},          
                            ]                
                         },
                         {
                            cols:[
                                { view:'text',label:'Email',name:'email',width:600,labelWidth:100,fillspace:true,css:'lowercase'},
                                {},
                            ] 
                         },                    
                         { 
                             rows:[ 
                                { template:"DATOS DE FACTURACION", type:"section"}
                             ]
                         },
                         { 
                             cols:[
                                { view:"text", label:"Rfc",name:'rfc',width:250},
                                { view:"text", label:"Razon Social", name:'razons'}				            
                             ]
                         },
                         {
                             rows:[
                                { view:'text',label:'Calle',name:'calle'}                         
                             ]
                         },
                         {
                             cols:[
                                { view:'text',label:'Entre Calle',name:'calle1'},
                                { view:'text',label:'Y Calle',name:'calle2'},
                             ]     
                         },
                         {
                             cols:[
                                { view:'text',label:'Exterior',name:'exterior'},
                                { view:'text',label:'Interior',name:'interior'},                            
                                { view:'text',label:'Cp',name:'cp',id:'cp'}                            
                             ]  
                         },
                         {
                             cols:[                                 
                                { view:'select',label:'Estado',name:'estado',value:1,options:app.urls.estados,on:{
                                        onChange:function(valor_n,valor_v){
                                           app.combo('municipios',app.urls.municipios+valor_n);
                                }
                                }}, 
                                { view:'select',label:'Municipio',name:'municipio',id:'municipios',value:1,options:app.urls.municipios+1,on:{
                                        onChange:function(valor_n1,valor_v1){
                                           app.combo('colonias',app.urls.colonias+valor_n1);
                                }   
                                }}
                             ]     
                         },
                         {
                             cols:[
                                { view:'select',label:'Colonia',name:'colonia',id:'colonias',value:1,width:800,options:app.urls.colonias+1},
                                {}
                             ]  
                         },
                         {
                             cols:[
                                {},
                                { view:"button", type:"imageButton",label:"grabar",	image:path+"save.gif",height:60,width:120,click:function(){
                                    if($$('fclientes').validate()){
                                    var data = $$('fclientes').getValues();
                                    app.guardar('Clientes/guardar',data,function(respuesta){
                                        respuesta=JSON.parse(respuesta);
                                        if(respuesta.success){
                                            $$('fclientes').clear();
                                            $$('fclientes').clearValidation();
                                            app.grid('dt_clientes','clientes');
                                            $$('c_form_clientes').hide();
                                        }
                                        console.log(respuesta);
                                    });                      
                                    }
                                }}, 
                                {view:'button', type:"imageButton",label:'cerrar',	image:path+"undo.gif",height:60,width:120,fillspace:true,click:function(){
                                    $$('c_form_clientes').hide();
                                }}                  
                            ]
                        },
                        {}
                    ],
                    elementsConfig:{
                            labelWidth:110
                    },
                    rules:{
                        /* telefono:webix.rules.isNumber*/
                        telefono:otelefono,
                        celular:otelefono,
                        cp:ocp,
                        /*email:webix.rules.isEmail*/
                    },    
                },                               
            ]
        }
    ],
}
   
        
                