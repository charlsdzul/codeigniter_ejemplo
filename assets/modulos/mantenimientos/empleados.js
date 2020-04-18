var path = "../sistema/imgs/";
var app_empleados={
    id:'win_empleados',
    cols:[
        {
            rows:[
                {
                  view:'toolbar',
                    cols:[
                        {view:'label',label:'Empleados'},
                        {view:'button',label:'Agregar',type:'icon',icon:'plus-circle',width:100,click:function(){
                            $$('fempleados').clear();
                            $$('fempleados').clearValidation();
                            $$('c_form_empleados').show();
                        }}
                    ]   
                },
                {
                  id:'dt_empleados',
                      view:'datatable',
                      navigation:true,            
                      select:'row',               
                        url:BASE_URL+'index.php/empleados',
                        columns:[
                            {id:'id',header:'Cuenta'},
                            {id:'nombre',header:['Nombre',{content:'textFilter'}],fillspace:true},                         
                            {id:'apepat',header:['Paterno',{content:'textFilter'}],fillspace:true},                         
                            {id:'apemat',header:['Materno',{content:'textFilter'}],fillspace:true},                         
                        ],
                         on:{
                             onItemDblClick:function(row){
                                 var item=this.getItem(row);
                                 $$('fempleados').load(BASE_URL + 'index.php/empleados/empleado/'+item.id);
                                 $$('c_form_empleados').show();
                             }
                         }  
                },
            ]    
        },
        {
            id:'c_form_empleados',
            hidden:true,
            rows:[
                {
                    view:'toolbar',
                    cols:[
                        {view:'label',label:'Datos del Empleado'}                            
                    ]
                },
                {
                       view:'form',
                       id:'fempleados',
                       elements:[
                           {  cols:[
                                    {view:'select',name:'plaza',label:'Plaza',id:'plazas',value:1,options:app.urls.plazas+1},
                                    {view:'select',name:'puesto',id:'puesto',label:'Puesto del Empleado',value:1,options:app.urls.tipoempleado+1},
                               ]
                           },
                                    {view:'text',name:'rfc',label:'RFC'},
                                    {view:'text',name:'nombre',label:'Nombre'},                            
                                    {view:'text',name:'apepat',label:'Paterno'},                            
                                    {view:'text',name:'apemat',label:'Materno'},
                                    {template:"DATOS IMPORTANTESDEL EMPLEADO", type:"section"},
                           {   cols:[
                                    {view:'text',name:'telefono',label:'Telefono'},                            
                                    {view:'text',name:'celular',label:'Celular'}, 
                               ]
                           },
                                    {view:'text',name:'correo',label:'Correo',css:'lowercase'},
                                    {view:'text',name:'tiposangre',label:'Tipo de Sangre'},                            
                                    {view:'text',name:'curp',label:'CURP'},
                                    {view:'text',name:'nss',label:'NSS'},
                                    {view:'text',name:'sueldo',label:'Sueldo',requiered:true},
                                    {view:"counter",name:'periodopago',label:"Periodo Pago",step:1,value:1},
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
                                                app.grid('dt_empleados','empleados');
                                                $$('c_form_empleados').hide();
                                            }
                                            console.log(respuesta);
                                        });                      
                                        }
                                     }}, 
                                     {view:'button', type:"imageButton",label:'cerrar',	image:path+"undo.gif",height:60,width:120,fillspace:true,click:function(){
                                            $$('c_form_empleados').hide();
                                     }}
                               ]
                            },
                            {}
                        ],
                        elementsConfig:{
                            labelWidth:160
                        },
                        rules:{
                            sueldo:webix.rules.isNumber,
                            sueldo:sueldo,
                            nombre:webix.rules.isNotEmpty,                     
                            apepat:webix.rules.isNotEmpty,                     
                            apemat:webix.rules.isNotEmpty,                     
                        },    
                },
            ]
        }
    ],
}