var path = "../sistema/imgs/";
var app_productos={
    //datatable, generar 2 ventanas
    id:'wproductos',
    view:'window',
    head:'PRODUCTOS',
    //hidden:false,
    modal:true,
    width:1200,
    height:800,
    position:'center',
    body:{
        rows:[           
            { 
                view:'form',
                id:'fproductos',
                elements:[
                     {
                        cols:[
                           { view:'text',label:'Nombre',name:'nombre',required:true},
                           { view:'combo',label:'Tipo',name:'tipo',value:1,yCount:2,width:300,options:[
                                    {id:1,value:'PALETA DE AGUA'},
                                    {id:2,value:'PALETA LECHE'}
                            ]},
                            { view:'combo',label:'Unidad',name:'unidad',value:1,yCount:2,width:300,options:[
                                    {id:1,value:'CAJA PALETA GRANDE'},'24',
                                    {id:2,value:'CAJA PALETA CHICA'},'12',
                            ]},                                         
                        ]                
                     },         
                     {
                         cols:[
                            { view:'text',label:'Costo',name:'costo',width:200},
                            { view:'text',label:'Precio Venta',name:'preciovta',width:200,labelWidth:120},
                            { view:'text',label:'Stock minimo',name:'stock',width:200,labelWidth:120},
                            { }
                         ]     
                     },
                     {
                        cols:[
                            {},
                            { view:"button", type:"imageButton",label:"grabar",	image:path+"save.gif",height:60,width:120,click:function(){
                                if($$('fproductos').validate()){
                                var data = $$('fproductos').getValues();
                                console.log(data);                        
                                }
                            }}, 
                            {view:'button', type:"imageButton",label:'cerrar',	image:path+"undo.gif",height:60,width:120,fillspace:true,click:function(){
                                $$('wproductos').hide();
                            }}                  
                        ]
                    },
                ],                
                rules:{
                    costo:webix.rules.isNumber,                    
                    preciovta:webix.rules.isNumber                    
                    
                }
            }
        ]
    },
}
    


webix.ready(function(){
   webix.ui(app_productos);     
});