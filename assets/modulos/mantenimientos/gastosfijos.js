var path = "../sistema/imgs/";
var app_gastosfijos={  
    id:'win_gastosfijos',
        cols:[     
            {
                rows:[
                    {
                        view:'toolbar',
                        cols:[
                            {view:'label',label:'Usuarios'},
                            {view:'button',label:'Agregar',type:'icon',icon:'plus-circle',width:100,click:function(){
                                $$('fgastosfijos').clear();
                                $$('fgastosfijos').clearValidation();
                                $$('c_form_gastosfijos').show();
                            }}
                        ]
                    },
                    {
                      id:'dt_gastosfijos',
                      view:'datatable',
                      navigation:true,            
                      select:'row',               
                        url:BASE_URL+'index.php/gastosfijos',
                        columns:[                            
                            {id:'id',header:['Clave',{content:'textFilter'}],fillspace:true},                         
                            {id:'nombre',header:['Nombre',{content:'textFilter'}],fillspace:true},                       
                            {id:'dh',header:['Tipo',{content:'textFilter'}],fillspace:true},                       
                        ],
                         on:{
                             onItemDblClick:function(row){
                                 var item=this.getItem(row);
                                 $$('fgastosfijos').load(BASE_URL + 'index.php/gastosfijos/gastofijo/'+item.id);
                                 $$('c_form_gastosfijos').show();
                             }
                         }
                    },
                ]
            },
            {
                id:'c_form_gastosfijos',
                hidden:true,
                rows:[
                    {
                        view:'toolbar',
                        cols:[
                            {view:'label',label:'Datos Gastos Fijos'}                            
                        ]
                    },
                    {                             
                       view:'form',
                       id:'fgastosfijos',
                       elements:[
                            {view:'text',name:'nombre',label:'Nombre',required:true},
                            {view:"radio", label:"Tipo", name:'dh', value:1, options:[
                                        { id:'D', value:'D (cargo)'}, 
                                        { id:'H', value:'H (Abono)'}
                            ]},
                            {
                               cols:[
                                     {},
                                     { view:"button", type:"imageButton",label:"grabar",	image:path+"save.gif",height:60,width:120,hotkey:'enter',click:function(){
                                        if($$('fgastosfijos').validate()){
                                                if($$('fgastosfijos').validate()){
                                                    var data = $$('fgastosfijos').getValues();
                                                    app.guardar('Gastosfijos/guardar',data,function(respuesta){
                                                    respuesta=JSON.parse(respuesta);
                                                    if(respuesta.success){
                                                        $$('fgastosfijos').clear();
                                                        $$('fgastosfijos').clearValidation();
                                                        app.grid('dt_gastosfijos','gastosfijos');
                                                        $$('c_form_gastosfijos').hide();
                                                    }                                              
                                                    console.log(respuesta);
                                                    });
                                                }
                                        }
                                     }}, 
                                     {view:'button', type:"imageButton",label:'cerrar',	image:path+"undo.gif",height:60,width:120,fillspace:true,click:function(){
                                            $$('c_form_gastosfijos').hide();
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
                    },
                ]
            }
        ],
}