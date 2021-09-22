<?php include_once 'modulos/mdl_login.php'; ?>
</!DOCTYPE html>
<html><!-- ******* AUTENTICAR ADMINISTRADOR, DOCENTE, REVIZOR Y ESTUDIANTE (RF-01)(RF-02)(RF-03) -->
    <head>
        <title>Título</title>

        <link rel="stylesheet" type="text/css" href="css/main.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/menu.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/forms.css" media="screen">

      <!--  <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/menu.css">
        <link rel="stylesheet" href="css/forms.css"> -->
        <meta charset="UTF-8">
    </head>
    <body>

    <div id="contenedor">
        <!-- Encabezado de la pagina-->
            <?php include_once 'modulos/mdl_header.php'; ?>
        <!-- contenido principal -->
<section>
        <section id="contenidoLogin">
            <article style="text-align: center;">

               	<form action="login.php" method="POST" style="margin: 0px; width: 100%; height: 80%">

                    <h2>Iniciar sesión</h2>
                    <p>Usuario: <br>
                    <input type="text" name="codigo"></p>
                    <p>Password: <br>
                    <input type="password" name="password"></p>
                    <p class="center"><input type="submit" value="Iniciar Sesión"></p>
                </form>

                <p style="color: RED;">
                    <?php if(isset($alert)) echo $alert; ?>
                </p>
            </article>
        </section>
</section>
        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

    </div>


    </body>
</html>
