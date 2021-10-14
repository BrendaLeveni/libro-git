    <head>
        <meta charset="utf-8" />
        <base href="{BASE_URL}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Libreria</title>
     
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
     
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
      
        <link href="templates/css/style2.css" rel="stylesheet"/>
        <link href="templates/css/styles.css" rel="stylesheet" />
    </head>
    <body>
        
        <nav class="navbar navbar-light bg-white static-top">
            <div class="container">
            
                <a class="navbar-brand " href="home" >Libreria</a>
                 <a class="navbar-brand" href="libros">Lista de libros</a>
                {foreach $generos as $genero}
                    <a class="navbar-brand" href="generos/{$genero->id_genero}">{$genero->nombre}</a>
                {/foreach}
                {if $email}
                    <a class ="btn btn-primary" href="logout">Desconectarse</a>
                {else}
                    <a class="btn btn-primary" href="login">Loguearse</a>
                {/if}
            </div>
        </nav>
        <header class="masthead">
            <div class="container position-relative">
             </div>
        </header>
       