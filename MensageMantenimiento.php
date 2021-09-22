</!DOCTYPE html>
<html>
    <head>
        <title>Taller</title>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/forms.css">
        <script language='javascript'>
            function regresar(){
            location.href='index.php'
            }
        </script>
        <meta charset="UTF-8">

    </head>
    <body>

    <div id="contenedor">
        <!-- Encabezado de la pagina-->
            <?php include_once 'modulos/mdl_header.php'; ?>
        <!-- contenido principal -->
        <section style="text-align: center; margin: 0 auto;">
            <article style="width: 800px; height: 350px;text-align: center; margin: 0 auto;">
               <a href="index.php">Regresar</a>
                 <div class="datagrid">

                 <img src="imgs/enConstruccion.jpg" border="1" alt="Imagen de google Images" width="600" height="500">

                </section>


        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

    </div>
  </div>
    </body>
</html>
