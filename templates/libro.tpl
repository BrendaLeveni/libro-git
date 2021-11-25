{include file="header.tpl"}

<h1>{$libro->titulo}</h1>
<p>{$libro->sinopsis}</p>
<p>paginas : {$libro->cant_pag}</p>


{if $email }
<form method="POST" action="libros/{$libro->id_libro}/editar">
<input type="text" name="titulo" value="{$libro->titulo}"/>
<input type="text" name="sinopsis" value="{$libro->sinopsis}"/>
<input type="number" name="cantidad_paginas" value="{$libro->cant_pag}"/>
<button type="submit">Editar</button>
</form>
<a href="libros/{$libro->id_libro}/borrar"><button type="submit">Eliminar</button></a>
<form id="addComentario">
<input type="text" name="comentario" id="comentario"/>
<input type="number" name="puntaje" id="puntaje"/>
<button type="submit">Enviar</button>
</form>
{/if}

<ul id="listaComentario">
</ul>

<script src="templates/js/scripts.js"></script>
{include file="footer.tpl"}