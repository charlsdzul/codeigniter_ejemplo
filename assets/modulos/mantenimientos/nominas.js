var app_nomina = {
	id:'nomina',
	cols:[
		{width:400},
		{
			rows:[
				{
					cols:[
						{view:'datepicker',label:'Periodo',format:'%Y-%m-%d',width:280,labelWidth:155},
						{view:'datepicker',label:'hasta',format:'%Y-%m-%d',width:200},	
						{}
					]
				},				
				{
					cols:[				
						{view:'combo',label:'Seleccione empleado',labelWidth:155,id:'empleado_id_n',options:app.urls.empleados},
						{view:'button',label:'Agregar',width:80,click:nomina_add_empleado},							
					]
				},
				{
					cols:[
						{
							gravity:2,
							rows:[
								{type:'section',template:'Empleados seleccionados'},
								{
									view:'datatable',
									id:'dt_nomina_empleados',
									select:'row',
									footer:true,
									columns:[
										{id:'nombre',header:'Empleado',fillspace:true},
										{id:'percepciones',header:'Percepciones',footer:{content:'summColumn',css:'t_right'},width:120,css:'t_right',format:quantity_format},
										{id:'deducciones',header:'Deducciones',footer:{content:'summColumn',css:'t_right'},width:120,css:'t_right',format:quantity_format},
										{id:'total',header:'Total',footer:{content:'summColumn',css:'t_right'},width:120,css:'t_right',format:quantity_format},
									],
									on:{
										onItemClick:function(i){
											var item = this.getItem(i);
											
										}
									}
								}
							]
						},
						{width:10},
						{
							rows:[
								{type:'section',template:'Detalle individual'},
								{
									view:'datatable',
									footer:true,
									columns:[
										{id:'nombre',header:'Concepto',fillspace:true},
										{id:'cantidad',header:'Cantidad',footer:{content:'summColumn',css:'t_right'},width:120,css:'t_right',format:quantity_format},
										{id:'tipo',header:'+/-',width:40},
									]
								}
							]
						},
					]
				}
			]
		}
	]
};
function nomina_add_empleado(){
	var conceptos = [];
	var empleado_id = $$('empleado_id_n').getValue();
	var empleado = {
		id:empleado_id,
		nombre:$$('empleado_id_n').getText(),
		percepciones:0.00,
		deducciones:0.00,
		total:0.00
	};
	var exist = false;
	if(webix.rules.isNumber(empleado_id)){
		$$('dt_nomina_empleados').eachRow(function(i){
			var item = this.getItem(i);
			if(item.id == empleado_id)
				exist = true;
		});
		if(!exist){
			$$('dt_nomina_empleados').add(empleado);
		}
	}
}
webix.ready(function(){webix.ui(app_nomina);});