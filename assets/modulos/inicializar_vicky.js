webix.ready(function(){

   webix.ui({

       rows:[

           {type:'header',template:'<font size="3" >HELADOS DEL PUEBLO <span style="float:right;">'+FECHA_OPERACION+'</span></font>'},

           {

               view:'scrollview',

               id:'scrollview',

               scroll:'x',               

               body:{

                   cols:[                       

                        {view:'button',type:"imageTop",label:'Desarrollos',image:path+"desarrollos.png",height:100,width:100,click:function(){                            

                            $$('win_clientes').show();

                            app.grid('dt_clientes','clientes');

                            $$('c_form_clientes').hide(); 

                        }},

                       {view:'button',type:"imageTop",label:'Usuarios',image:path+"usuarios1.png",height:100,width:100,click:function(){                             

                             $$('win_usuarios').show();

                             app.grid('dt_usuarios','usuarios');

                             $$('c_form_usuario').hide();

                       }},

                       {view:'button',type:"imageTop",label:'Empleados',image:path+"empleados1.png",height:100,width:100,click:function(){

                             //$$('wempleados').show();

                             $$('win_empleados').show();

                             app.grid('dt_empleados','empleados');

                             $$('c_form_empleados').hide();                     

                       }},

                       {view:'button',type:"imageTop",label:'Clientes',image:path+"cliente1.png",height:100,width:100,click:function(){

                             //$$('wclientes').show();

                             $$('win_clientes').show();

                             app.grid('dt_clientes','clientes');

                             $$('c_form_clientes').hide(); 

                       }},

                       {view:'button',type:"imageTop",label:'Cedis',image:path+"sucursal1.png",height:100,width:100,click:function(){

                             $$('win_cedis').show();

                             app.grid('dt_cedis','cedis');

                             $$('c_form_cedis').hide();

                       }},

                       {view:'button',type:"imageTop",label:'Proveedores',image:path+"proveedor1.png",height:100,width:100,click:function(){

                             $$('win_proveedor').show();

                             app.grid('dt_proveedor','proveedores');

                             $$('c_form_proveedor').hide();   

                       }},

                       {view:'button',type:"imageTop",label:'Productos',image:path+"productos1.png",height:100,width:100,click:function(){

                             $$('win_productos').show();

                             app.grid('dt_productos','productos');

                             $$('c_form_productos').hide();

                       }},

                       {view:'button',type:"imageTop",label:'Gastos Fijos',image:path+"gastos1.png",height:100,width:100,click:function(){

                             $$('win_gastosfijos').show();

                             app.grid('dt_gastosfijos','gastosfijos');

                             $$('c_form_gastosfijos').hide();

                       }},

                       {view:'button',type:"imageTop",label:'Mapa',image:path+"maps.png",height:100,width:100,click:function(){

                             $$('win_mapa').show();
                             
                              }

                        },

                       {view:'button',type:"imageTop",label:'Salir',image:path+"salir.png",height:100,width:100,click:function(){

                             webix.confirm('Desea salir del sistema',function(r){

                                if(r)

                                    document.location=BASE_URL+'index.php/welcome/dologout';

                             });

                       }},

                       /*{view:'button',type:"imageTop",label:'Venta',image:path+"caja1.png",height:100,width:100,click:function(){

                             $$('wventas').show();

                       }},*/

                   ]                      

               }       

           },

           {        

                cells:[

                    {

                      id:'dt_cliente',

                      view:'datatable',

                      navigation:true,            

                      select:'row',               

                        url:BASE_URL+'index.php/clientes',

                        columns:[

                            {id:'id',header:'Cuenta'},

                            {id:'nombres',header:['nombres',{content:'textFilter'}],fillspace:true},

                            {id:'apepat',header:['apepat',{content:'textFilter'}],fillspace:true},

                            {id:'apemat',header:['apemat',{content:'textFilter'}],fillspace:true},

                            {id:'saldo',header:['Saldo',{content:'selectFilter'}],fillspace:true,

                                css:'t_right', 

                                format:webix.Number.numToStr({

                                        groupDelimiter:",",

                                        groupSize:3,

                                        decimalDelimiter:".",

                                        decimalSize:2

                                })

                            },

                        ],

                         on:{

                             onItemDblClick:function(row){

                                 var item=this.getItem(row);

                                 $$('frm_cliente_lectura').load(BASE_URL + 'index.php/clientes/cliente/'+item.id);

                                 $$('wpagos').show();

                             }

                         }

                    },                                        

                    app_usuarios,

                    app_empleados,

                    app_clientes,

                    app_cedis,                    

                    app_proveedor,

                    app_productos,

                    app_gastosfijos,

                    app_mapa

                ]

           }

       ]     

       

   });    

});