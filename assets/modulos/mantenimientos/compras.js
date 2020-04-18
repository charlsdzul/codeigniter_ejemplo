var app_compra = {
	id:'compra',
	cols:[
		{
			rows:[				
				{view:'combo',label:'Proveedor',id:'proveedor_id_c',options:app.urls.proveedores,labelWidth:110,labelPosition:'left',required:true,on:{
					onChange:function(n,o){						
						if(webix.rules.isNumber(n)){
							var proveedor = $$('proveedor_id_c').getList().getItem(n);							
							$$('frm_compra').setValues(proveedor);
						}
					}
				}},
				{
					view:'form',
					id:'frm_compra',
					borderless:true,
					elements:[
						{type:'section',template:'Datos del proveedor'},
						{
							cols:[
								{view:'text',name:'value',label:'Nombre',disabled:true},
								{view:'text',name:'correo',label:'Correo',disabled:true},
								{view:'text',name:'telefono',label:'Telefono',disabled:true},
								{view:'text',name:'celular',label:'Celular',disabled:true},									
							]
						},
						{
							cols:[
								{view:'text',name:'direccion',label:'Direccion',disabled:true,colspan:2},
								{view:'text',name:'municipio',label:'Municipio',disabled:true},
								{view:'text',name:'estado',label:'Estado',disabled:true}
							]
						}
					],
					elementsConfig:{labelPosition:'top'}
				},
				{type:'section',template:'Datos de la compra'},
				{
					cols:[
						{view:'combo',label:'Seleccione un producto',id:'producto_id_c',options:app.urls.productos,labelWidth:200},
						{view:'button',label:'Agregar',width:100,click:function(){
							var id = $$('producto_id_c').getValue();
							var exist = false;
							if(webix.rules.isNumber(id)){																
								var producto = $$('producto_id_c').getList().getSelectedItem();
								var producto_dt = $$('dt_productos_c').getItem(producto.id);								
								if(producto_dt==undefined){			
									producto.entrada = 1;									
									producto.cantidad = 1;									
									producto.producto = producto.value;									
									producto.costo = producto.preciovta; 
									producto.total=producto.costo*producto.cantidad;
									$$('dt_productos_c').add(producto);									
									$$('producto_id_c').setValue("");
								}								
							}
						}},						
					]
				},
				{height:10},
				{
					view:'datatable',
					id:'dt_productos_c',
					footer:true,
					editable:true,
					columns:[
						{id:'producto',header:'Producto',fillspace:true,footer:{text:'Total',colspan:5,css:'t_right'}},
						{id:'unidad',header:'Unidad',fillspace:true},
						{id:'costo',header:'Costo',css:'t_right',format:std_format,css:'t_right'},
						//{id:'entrada',header:'Entrada',css:'t_right'},
						{id:'cantidad',header:'Piezas',css:'t_right', editor:"text"},
						{id:'total',header:'Total',format:std_format,footer:{content:'summColumn',css:'t_right',format:std_format},css:'t_right'},						
					],
					on:{						
						onAfterEditStop:function(values,view){
							var obj = this.getItem(view.row);
							if(view.column=="cantidad" || view.column=="costo"){
									if(obj.cantidad=="" || obj.costo==undefined)obj.cantidad=0;
									if(obj.costo=="" || obj.costo==undefined)obj.costo=0; 
									obj.total=parseFloat(obj.costo)*parseInt(obj.cantidad);								
									this.updateItem(view.row,obj);	
							} 
						}
					},
					rules:{
						costo:function(value){ return value > 0; },
						entrada:function(value){ return value > 0; }
					},
				},
				{
					cols:[
						{},
						{view:'button',label:'Cancelar',type:'danger',width:180,click:function(){
							webix.confirm('Desea cancelar la compra?',function(r){	
								$$('proveedor_id_c').setValue('');
								$$('frm_compra').clear();
								$$('dt_productos_c').clearAll();
								$$('producto_id_c').setValue("");
							});
						}},
						{view:'button',label:'Finalizar compra',type:'form',width:180,click:function(){
							if(!webix.rules.isNumber($$('proveedor_id_c').getValue())){
								webix.alert("Seleccione un proveedor");
								return false;
							}							
							if($$('dt_productos_c').count()==0){
								webix.alert("Debe de indicar al menos un producto");
								return false;
							}
							if(!$$('dt_productos_c').validate()){
								webix.alert("Las cantidades capturadas deben de ser numericas");
								return false;
							}
							webix.confirm('Desea finalizar la compra?',function(r){																	
								if(r){
									var total = 0.00;
									var compra = {
										proveedor_id:$$('proveedor_id_c').getValue(),
										productos:[],
										total:0
									};								
									$$('dt_productos_c').eachRow(function(row){
										var p = this.getItem(row);
										if(p.entrada > 0){
											compra.productos.push({
												producto_id:p.id,
												unidad_id:p.unidad_id,
												piezas:p.piezas,
												cantidad:p.cantidad, 
												precio:p.costo
											});
											total+=float_parse(p.total);
										}
									});							
									compra.importe = total;
									app.guardar('compras/save',compra,function(response){
										response = JSON.parse(response);
										if(response.status === true){
											webix.alert('Compra registrada');
											$$('proveedor_id_c').setValue('');
											$$('frm_compra').clear()
											$$('dt_productos_c').clearAll();
											$$('producto_id_c').setValue("");
										}
										
									});
									console.log(compra);									
								}
							});
						}}
					]
				}
			]
		},
		//{}
	]
};
//webix.ready(function(){webix.ui(app_compras);});