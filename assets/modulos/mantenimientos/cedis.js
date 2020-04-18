var path = "../sistema/imgs/";
var app_cedis={
    id:'win_cedis',
    cols:[
        {
            rows:[
                {
                    view:'toolbar',
                        cols:[
                            {view:'label',label:'Cedis'},
                            {view:'button',label:'Agregar',type:'icon',icon:'plus-circle',width:100,click:function(){
                                $$('fcedis').clear();
                                $$('fcedis').clearValidation();
                                $$('c_form_cedis').show();
                            }}
                        ]   
                },
                {
                    id:'dt_cedis',
                    view:'datatable',
                    navigation:true,            
                    select:'row',               
                    url:BASE_URL+'index.php/cedis',
                    columns:[                                                     
                        {id:'nombre',header:['Nombre',{content:'textFilter'}],fillspace:true},                         
                    ],
                    on:{
                        onItemDblClick:function(row){
                        var item=this.getItem(row);
                            $$('fcedis').load(BASE_URL + 'index.php/cedis/cedi/'+item.id);
                            $$('c_form_cedis').show();
                        }
                    }
                },
            ]
        },
        {
            id:'c_form_cedis',
            hidden:true,
            rows:[
                {
                        view:'toolbar',
                        cols:[
                            {view:'label',label:'Datos Centro de Distribucion'}                            
                        ]                       
                },
                {
                    view:'form',
                    id:'fcedis',
                    elements:[
                         {
                            cols:[
                               { view:'text',label:'Nombre',name:'nombre',required:true}                                                             
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
                                { view:'text',label:'Cp',name:'cp'}                            
                             ]  
                          },
                          {
                             cols:[                            
                                { view:'select',label:'Estado',name:'estado',value:1,options:app.urls.estados,on:{
                                    onChange:function(valor_n,valor_v){
                                       app.combo('municipiosc',app.urls.municipios+valor_n);
                                    }
                                }},                             
                                { view:'select',label:'Municipio',name:'municipio',id:'municipiosc',value:1,options:app.urls.municipios+1,on:{
                                    onChange:function(valor_n1,valor_v1){
                                       app.combo('coloniasc',app.urls.colonias+valor_n1);
                                    },
                                }},                                
                             ]     
                          }, 
                                { view:'select',label:'Colonia',name:'colonia',id:'coloniasc',value:1,options:app.urls.colonias+1},
                          {
                            cols:[
                                {},
                                { view:"button", type:"imageButton",label:"grabar",	image:path+"save.gif",height:60,width:120,click:function(){
                                    if($$('fcedis').validate()){
                                        if($$('fcedis').validate()){
                                            var data = $$('fcedis').getValues();
                                            app.guardar('Cedis/guardar',data,function(respuesta){
                                            respuesta=JSON.parse(respuesta);
                                            if(respuesta.success){
                                                $$('fcedis').clear();
                                                $$('fcedis').clearValidation();
                                                app.grid('dt_cedis','cedis');
                                                $$('c_form_cedis').hide();
                                            }                                              
                                            console.log(respuesta);
                                            });
                                        }
                                    }
                                }}, 
                                {view:'button', type:"imageButton",label:'cerrar',	image:path+"undo.gif",height:60,width:120,fillspace:true,click:function(){
                                    $$('c_form_cedis').hide();
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
    
    
    
    
        
                
                
          
   

