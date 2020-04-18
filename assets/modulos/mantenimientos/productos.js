var path = "../sistema/imgs/";
var app_productos={
    id:'win_productos',
    cols:[
        {
            rows:[
                {
                    view:'toolbar',
                    cols:[
                        {view:'label',label:'Productos'},
                        {view:'button',label:'Agregar',type:'icon',icon:'plus-circle',width:100,click:function(){
                            $$('fproductos').clear();
                            $$('fproductos').clearValidation();
                            $$('c_form_productos').show();
                        }}
                    ]
                },
                {
                    id:'dt_productos',
                    view:'datatable',
                    navigation:true,
                    select:'row',
                    url:BASE_URL+'index.php/productos',
                    columns:[
                        {id:'nombre',header:['Nombre',{content:'textFilter'}],fillspace:true}
                    ],
                    on:{
                        onItemDblClick:function(row){
                            var item=this.getItem(row);
                            $$('fproductos').load(BASE_URL+'index.php/productos/producto/'+item.id);
                            $$('c_form_productos').show();
                        }
                    }
                },
            ]
        },
        {
            id:'c_form_productos',
            hidden:true,
            rows:[
                {
                    view:'toolbar',
                    cols:[
                        {view:'label',label:'Datos de Productos'}
                    ]
                },
                {
                    view:'form',
                    id:'fproductos',
                    elements:[
                         { view:'text',label:'Nombre',name:'nombre',required:true},
                         {
                            cols:[
                               {view:'select',name:'id_tipo_producto',label:'Tipo Producto',id:'tipoproducto',value:1,options:app.urls.tipoproductos+1},
                               {view:'select',name:'id_unidades',label:'Unidad',id:'unidadproductos',value:1,options:app.urls.unidadproductos+1},                                         
                            ]                
                         },         
                         {
                             cols:[
                                { view:'text',label:'Costo',name:'costo'},
                                { view:'text',label:'Precio Venta',name:'preciovta'},
                                { view:'text',label:'Stock minimo',name:'stock'},
                                { }
                             ]     
                         },
                         {
                            cols:[
                                {},
                                { view:"button", type:"imageButton",label:"grabar",	image:path+"save.gif",height:60,width:120,click:function(){
                                    if($$('fproductos').validate()){
                                            if($$('fproductos').validate()){
                                                var data = $$('fproductos').getValues();
                                                app.guardar('Productos/guardar',data,function(respuesta){
                                                respuesta=JSON.parse(respuesta);
                                                if(respuesta.success){
                                                    $$('fproductos').clear();
                                                    $$('fproductos').clearValidation();
                                                    app.grid('dt_productos','productos');
                                                    $$('c_form_productos').hide();
                                                }                                              
                                                console.log(respuesta);
                                                });
                                            }
                                    }
                                }}, 
                                {view:'button', type:"imageButton",label:'cerrar',	image:path+"undo.gif",height:60,width:120,fillspace:true,click:function(){
                                    $$('c_form_productos').hide();
                                }}                  
                            ]
                        },
                        {}
                    ],
                    elementsConfig:{
                        labelWidth:120
                    },
                    rules:{
                        costo:costo,
                        preciovta:preciovta,
                        stock:stock
                        /*costo:webix.rules.isNumber,                    
                        preciovta:webix.rules.isNumber,
                        stock:webix.rules.isNumber  */                      
                    },                    
                },
            ]
        }
    ],    
}