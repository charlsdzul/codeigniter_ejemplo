    <?php  //CREACIÓN DE FORMULARIO CON HELPER  DE CI
        echo form_open('/charls/recibirdatos');

        $ciudad= array(
            'name' => 'ciudad',
            'placeholder'=> 'Escribe una ciudad'
        ) ;



        $id_ciudad= array(
            'name' => 'id_ciudad',
            'placeholder'=> 'Escribe ID de su estado'    
            ) ;

            $id_estado= array(
                'name' => 'id_estado',
                'placeholder'=> 'Escribe ID de su estado'    
                ) ;
    ?>


    <?= form_label('Ciudad', 'ciudad'); ?> 
        <?= form_input($ciudad); ?>

        
    <?= form_label('ID_Ciudad', 'id_ciudad'); ?> 
        <?= form_input($id_ciudad); ?>

    <?= form_label('ID_Estado', 'id_estado'); ?> 
        <?= form_input($id_estado); ?>



    <?= form_submit('', 'Guardar'); ?>
<?= form_close(); ?>
<body>
    
</body>