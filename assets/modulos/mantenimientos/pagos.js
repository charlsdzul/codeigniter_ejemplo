var testObject = {};
var global_id_cliente=0; 
var form_clientes = {
	view:"form",
	id:"form_rclientes",
	elements:[
			{ 
				cols:[
					{
						rows:[
							{
								cols:[
								{view:"text", name:"id", label:"Cuenta", disabled:true},
								{view:"text", name:"nombres", label:"Nombre", disabled:true},
								{view:"text", name:"saldo", labelWidth:100, label:"Saldo actual", disabled:true},
								]
							},
							{
								cols:[
								{view:"text", name:"email", labelWidth:50, label:"Email", disabled:true},
								{view:"text", name:"rfc", labelWidth:50, label:"Rfc", disabled:true},
								{view:"text", name:"celular", labelWidth:65, label:"Celular", disabled:true}
								]
							}
						]
					}
					
					 
				]  
			},
			{
			view:"tabbar", id:"tab", on:{ onChange:function(i){
				if(i=="historico"){
					$$("btn-pagar").disable();
					$$("tarjeta_historico").disable();
					$$("efectivo_historico").disable();
				}
				else{
					$$("btn-pagar").enable();
				}
					$$("tarjeta_historico").setValue("");
					$$("efectivo_historico").setValue("");
				var item=$$("dt_clientes").getItem(global_id_cliente);
				 $$('ventas_sl').clearAll();
				 $$('ventas_sl').load(BASE_URL+"index.php/clientes/ventas_sl/"+$$("dt_clientes").getItem(global_id_cliente).id);
				 $$('ventas_historico').clearAll();   
				 $$('ventas_historico').load(BASE_URL+"index.php/clientes/ventas_lq/"+$$("dt_clientes").getItem(global_id_cliente).id);
				 
			}}, borderless:true, multiview:true, options:[{value:'Ventas activas', id:'activas'},{value:'Historico',id:'historico'}]
			}, 
			 {
				cells:[
					{
							id:"activas",
							cols:[
								{
									view:"fieldset", 
									label:"Ventas sin liquidar", 
									body:{
										rows:[
											{
												cols:[
													{view:"fieldset", 
														label:"Ventas",
														width:300,
														body: 
														{view:"datatable", select:"row", height:300, scroll:true, scrollX:true, scrollY:true, navigation:true, id:"ventas_sl", url:BASE_URL+"index.php/clientes/ventas_sl",
														columns:[
															{id:'id', hidden:true},
															{id:'folio',width:50, header:['Folio',{content:'textFilter'}]} , 
															{id:'fecha',width:50,header:['Fecha',{content:'textFilter'}],fillspace:true},                         
															{id:'importe',width:50, header:['Importe',{content:'textFilter'}],fillspace:true},                         
															//{id:'saldo',header:['Saldo',{content:'selectFilter'}],css:'t_right',format:std_format},
														],
														on:{
															onItemClick:function(row,e){
																var item = this.getSelectedItem();
																$$("dt_pagos").clearAll();  
																$$("dt_pagos").load(BASE_URL+"index.php/clientes/getPagos/"+item.id); 
															
															},  
															onAfterLoad:function(){
																if($$("tab").getValue()=="activas"){
																	$$("btn-pagar").enable(); 
																}
															}
						
														}
													}},
													{view:"fieldset",
													label:"Detalle",
													body:
													{view:"datatable", editable:true, select:"row", height:300, scroll:true, scrollX:true, scrollY:true, navigation:true, id:"dt_pagos", url:BASE_URL+"index.php/clientes/get_pagos",
														columns:[
															{id:'id', hidden:true} , 
															{id:"precio", width:70,hidden:true},
															{id:"id_producto",width:70,hidden:true},
															{id:"nombre", fillspace:true,header:['Productos']},
															{id:"cantidad", width:90,header:["Cantidad"]},
															{id:"total", width:70,header:["Total"]},
															{id:"merma", width:70,editor:"text", header:["Merma"]},
															{id:"totalmerma",width:70,header:["Total merma"]},
															{id:"subtotal",width:70,header:["Subtotal"]} 
														],  
														on:{ 
															onAfterEditStop: function(state,editor,ignoreUpdate){
																//validarEnvio(state,editor,ignoreUpdate); 
																var actualid=this.getSelectedItem().id;
																var finalid=this.getItem(this.getLastId()).id;
																var new_val=0,totalmerma=0,subtotal=0; 
															 
																var new_row = this.getItem(editor.row);	
																new_val = (isNaN(parseInt(state.value)))?0:parseInt(state.value);
																new_val = (new_val < 0)?0:new_val;
																var cantidad=parseInt(new_row.cantidad);
																new_val = (new_val>cantidad)?cantidad:new_val;
																totalmerma = new_val*parseFloat(new_row.precio);
																subtotal = parseFloat(new_row.total) - totalmerma;		
																if(state.value != state.old){
																	if(editor.column == 'merma'){	
																		new_row.totalmerma = totalmerma.toFixed(2);	
																		new_row.subtotal = subtotal.toFixed(2);	
																		new_row.merma = new_val;
																		$$('dt_pagos').updateItem(editor.row, new_row);				
																	} 
																var canti=0 
																var tot=0;
																var subtot=0;
																var mer=0; 
																var submer=0;
																this.eachRow(function(row){
																	canti+=parseInt(this.getItem(row).cantidad);
																	tot+=parseFloat(this.getItem(row).total);
																	subtot+=parseFloat(this.getItem(row).subtotal);
																	if(this.getItem(row).merma!="" && !isNaN(this.getItem(row).merma))
																	mer+=parseInt(this.getItem(row).merma);
																	if(this.getItem(row).totalmerma!="" && !isNaN(this.getItem(row).totalmerma))
																	submer+=parseFloat(this.getItem(row).totalmerma);
																	
																});
																var res_row = {};
																res_row.nombre="Resumen";
																res_row.cantidad=canti;
																res_row.total=tot.toFixed(2);
																res_row.subtotal=subtot.toFixed(2); 
																res_row.merma=mer;
																res_row.totalmerma=submer.toFixed(2);
																$$("forma_total").setValues(res_row);
																
																} 
																
															},
															//productos, cantidad, total, merma, total, subtotal
															onAfterLoad: function(){
																var canti=0 
																var tot=0;
																var subtot=0;
																var mer=0; 
																var submer=0;
																this.eachRow(function(row){
																	canti+=parseInt(this.getItem(row).cantidad);
																	tot+=parseFloat(this.getItem(row).total);
																	subtot+=parseFloat(this.getItem(row).subtotal);
																	if(this.getItem(row).merma!="" && !isNaN(this.getItem(row).merma))
																	mer+=parseInt(this.getItem(row).merma);
																	if(this.getItem(row).totalmerma!="" && !isNaN(this.getItem(row).totalmerma))
																	submer+=parseFloat(this.getItem(row).totalmerma);
																	 
																});
																var res_row = {};
																res_row.nombre="Resumen";
																res_row.cantidad=canti;
																res_row.total=tot.toFixed(2);
																res_row.subtotal=subtot.toFixed(2); 
																res_row.merma=mer;
																res_row.totalmerma=submer.toFixed(2);
																$$("forma_total").setValues(res_row);
															},
															onItemClick:function(){
																//$$("forma_total").setValues(this.getSelectedItem());
																//console.log($$("forma_total").getValues());
															}
														}
														
													}}
												]
											},
											{
												rows:[{
													cols:[
														{},
														{
															view:"form",
															id:"forma_total",
															elements:[ 
														
																{
																	cols:[ 
																	{width:520, view:"text",disabled:true,id:"nombre", name:"nombre", value:"Resumen"},
																	{view:"text",disabled:true,id:"cantidad",name:"cantidad", value:"Cantidad"},
																	{view:"text",disabled:true,id:"total",name:"total", value:"Total"},
																	{view:"text",disabled:true,id:"merma",name:"merma", value:"Merma"},
																	{view:"text",disabled:true,id:"totalmerma",name:"totalmerma", value:"Total merma"},
																	{view:"text",disabled:true,id:"subtotal",name:"subtotal",value:"Subtotal"},
																	]
																}
														
															
																
															]
														}
													]
												},
												{
												cols:[
													{},
													{},
													{},
													{
														view:"form",
														id:"forma_pago",
														elements:[
															{view:"text",id:"tarjeta", label:"Tarjeta", name:"tarjeta"},
															{view:"text",id:"efectivo", label:"Efectivo", name:"efectivo"} 
														],
														rules:{
															"tarjeta":webix.rules.isNotEmpty,
															"tarjeta":webix.rules.isNumber,
															"efectivo":webix.rules.isNotEmpty,
															"efectivo":webix.rules.isNumber
														}
													}
													
												]
												}]
											}
											
										]
									}
								}
							
							]
					},
					{
						 id:"historico",
						 cols:[
							{
									view:"fieldset", 
									label:"Ventas liquidadas",  
									body:{
										rows:[
										{
											cols:[
														{view:"fieldset", 
														label:"Ventas",
														width:300,
														body: 
														{view:"datatable", select:"row", height:300, scroll:true, scrollX:true, scrollY:true, navigation:true, id:"ventas_historico", url:BASE_URL+"index.php/clientes/ventas_saldadas",
														columns:[
															{id:'id', hidden:true},
															{id:'id_pago', hidden:true}, 
															{id:'folio',width:50, header:['Folio',{content:'textFilter'}]} ,  
															{id:'fecha',width:50,header:['Fecha',{content:'textFilter'}],fillspace:true},                         
															{id:'importe',width:50, header:['Importe',{content:'textFilter'}],fillspace:true},                         
															//{id:'saldo',header:['Saldo',{content:'selectFilter'}],css:'t_right',format:std_format},
														], 
														on:{
															onItemClick:function(row,e){
																var item = this.getSelectedItem();
																console.log(item);   
																$$("dt_pagos_historico").clearAll();  
																$$("dt_pagos_historico").load(BASE_URL+"index.php/clientes/getPagosLiquidados/"+item.id); 
																webix.ajax().post(BASE_URL+"index.php/clientes/getFormasDePago",{id:item.id},function(r){
																	r=JSON.parse(r);
																	for(var i=0; i<r.length; i++){
																		if(parseInt(r[i].forma_pago_id)==2){
																			$$("tarjeta_historico").setValue(r[i].cantidad);
																		}
																		if(parseInt(r[i].forma_pago_id)==1){
																			$$("efectivo_historico").setValue(r[i].cantidad);
																		}
																	}
																});

															},  
															
														}
														
													}},
													{view:"fieldset",
													label:"Detalle",
													body:
													{view:"datatable", select:"row", height:300, scroll:true, scrollX:true, scrollY:true, navigation:true, id:"dt_pagos_historico", url:BASE_URL+"index.php/clientes/getPagosLiquidados",
														columns:[
															{id:'id', hidden:true} , 
															{id:"precio", width:70,hidden:true},
															{id:"id_producto",width:70,hidden:true},
															{id:"nombre", fillspace:true,header:['Productos']},
															{id:"cantidad", width:90,header:["Cantidad"]},
															{id:"total", width:70,header:["Total"]},
															{id:"merma", width:70,header:["Merma"]},
															{id:"totalmerma",width:130,header:["Total merma"]},
															{id:"subtotal",width:80,header:["Subtotal"]} 
														],
														on:{
															onAfterLoad:function(){
																 var canti=0 
																var tot=0;
																var subtot=0;
																var mer=0; 
																var submer=0;
																this.eachRow(function(row){
																	canti+=parseInt(this.getItem(row).cantidad);
																	tot+=parseFloat(this.getItem(row).total);
																	subtot+=parseFloat(this.getItem(row).subtotal);
																	if(this.getItem(row).merma!="" && !isNaN(this.getItem(row).merma))
																	mer+=parseInt(this.getItem(row).merma);
																	if(this.getItem(row).totalmerma!="" && !isNaN(this.getItem(row).totalmerma))
																	submer+=parseFloat(this.getItem(row).totalmerma);
																	 
																});
																var res_row = {};
																res_row.nombre_historico="Resumen";
																res_row.cantidad_historico=canti;
																res_row.total_historico=tot.toFixed(2);
																res_row.subtotal_historico=subtot.toFixed(2); 
																res_row.merma_historico=mer;
																res_row.totalmerma_historico=submer.toFixed(2);
															res_row.total_historico=res_row.total_historico-res_row.totalmerma_historico;
																$$("forma_total_historico").setValues(res_row);
															}
														}
														
															//productos, cantidad, total, merma, total, subtotal	
														}
														
													}
											
											]
										},
										{
											cols:[
											{
												
											},
											{
												view:"form",
											id:"forma_total_historico",
											elements:[ 
										
												{
													cols:[
													{width:460, view:"text",disabled:true,id:"nombre_historico", name:"nombre_historico", value:"Resumen"},
													{view:"text",disabled:true,id:"cantidad_historico",name:"cantidad_historico", value:"Cantidad"},
													{view:"text",disabled:true,id:"total_hstorico",name:"total_historico", value:"Total"},
													{view:"text",disabled:true,id:"merma_historico",name:"merma_historico", value:"Merma"},
													{view:"text",disabled:true,id:"totalmerma_historico",name:"totalmerma_historico", value:"Total merma"},
													{view:"text",disabled:true,id:"subtotal_historico",name:"subtotal_historico",value:"Subtotal"},
													]
												}
										
											
												
											]
											}
											]
											
														
										},
										{
											cols:[
												{},
												{},
												{},
												{
														view:"form",
														id:"forma_pago_historico",
														elements:[
															{view:"text",id:"tarjeta_historico", label:"Tarjeta", name:"tarjeta"},
															{view:"text",id:"efectivo_historico", label:"Efectivo", name:"efectivo"} 
														],
														rules:{
															"tarjeta":webix.rules.isNotEmpty,
															"tarjeta":webix.rules.isNumber,
															"efectivo":webix.rules.isNotEmpty,
															"efectivo":webix.rules.isNumber
														}
													}
											]
										}
										
										]
									}
							}
						 ]
					}
				]
			 },
			{
				cols:[
					{},
					{},
					{view:"button", label:"Cerrar", click:function(){
						this.getTopParentView().hide();
					}},
					{view:"button", id:"btn-pagar", label:"Pagar", click:function(){
						var form = $$("forma_pago");
						var pagotarjeta=parseFloat($$("tarjeta").getValue());
						var pagoefectivo = parseFloat($$("efectivo").getValue());
						var subtotal=parseFloat($$("forma_total").getValues().subtotal);
						if(form.validate()){
							if((pagotarjeta+pagoefectivo)==subtotal){
								this.disable(); 
								var data={};
								data.mermas = [];
								var i=0;
								$$("dt_pagos").eachRow(function(row){
									//Datos para la tabla de proc_mermas
									if($$("dt_pagos").getItem(row).merma!=undefined){
									data.mermas[i]={};
									data.mermas[i].id_producto=$$("dt_pagos").getItem(row).id_producto; 
									data.mermas[i].id_venta = $$("ventas_sl").getSelectedItem().id;
									data.mermas[i].id_cliente = $$("dt_clientes").getItem(global_id_cliente).id;
									data.mermas[i].cantidad=$$("dt_pagos").getItem(row).merma;
									data.mermas[i].precio=$$("dt_pagos").getItem(row).precio; 
									i++; 
									}
								});
								//pagos
								//id_usuario, tipo_cliente, plaza_id, cliente_id, forma_pago_id, cantidad, fecha
								var tbl=$$("dt_clientes").getItem(global_id_cliente);
								var ventas=$$("ventas_sl").getSelectedItem();
								//Datos para la tabla proc_pagos
								data.pagos={};
								data.pagos.tipo_cliente=tbl.tipocliente;
								data.pagos.cliente_id=tbl.id;
								data.pagos.cantidad=subtotal;
								data.pagos.pagotarjeta=pagotarjeta;
								data.pagos.pagoefectivo=pagoefectivo; 
								//datos para la tabla proc_pagos_venta 
								//pago_id, venta_id, cantidad
								data.pagos_venta = {};
								data.pagos_venta.cantidad=subtotal;
								data.pagos_venta.venta_id=ventas.id;
								 //datos para la tabla mermas
								  
								//data.pagotarjeta=pagotarjeta;
								//data.pagoefectivo=pagoefectivo;
								
								webix.ajax().post(BASE_URL+"index.php/clientes/pagar",{data},function(response){
									var item=$$("dt_clientes").getItem(global_id_cliente);
									 $$('ventas_sl').clearAll(); 
									 $$('ventas_sl').load(BASE_URL+"index.php/clientes/ventas_sl/"+item.id);
									$$('dt_pagos').clearAll(); 
									$$("dt_clientes").clearAll(); //Limpia datagrid de clientes
									$$("dt_clientes").load(BASE_URL+"index.php/Clientes"); //Lo recarga con el nuevo saldo
									webix.alert("Pago registrado");
									$$("tarjeta").setValue("");
									$$("efectivo").setValue("");   
									$$("nombre").setValue("");
									$$("cantidad").setValue("");
									$$("total").setValue("");
									$$("merma").setValue("");
									$$("totalmerma").setValue("");
									$$("subtotal").setValue("");
								});
							}
							else{ 
								webix.alert("Ingresar la cantidad correcta");
							}
						}
					}}
					
				]
			}
	]
}

 
 
var DIALOG_PAGOS = { 
	view:"window",
	id:"dlg_pagos",
	position:"center",  
	width:1900,
	modal:true,
	height:1800,
	body:webix.copy(form_clientes),
	on:{
		onShow:function(){
			global_id_cliente = $$("dt_clientes").getSelectedItem().id;
		}
	}
};