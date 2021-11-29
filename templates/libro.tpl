{include file="header.tpl"}

<h1>{$libro->titulo}</h1>
<p>Sinopsis:</p>
<p>{$libro->sinopsis}</p>
<p>paginas : {$libro->cant_pag}</p>


{if $email }
<form method="POST" action="libros/{$libro->id_libro}/editar">
<label>Titulo</label>
<input type="text" name="titulo" value="{$libro->titulo}"/>
<label>Sinopsis</label>
<input type="text" name="sinopsis" value="{$libro->sinopsis}"/>
<label>Cantidad de paginas</label>
<input type="number" name="cantidad_paginas" value="{$libro->cant_pag}"/>
<select name="genero">
{foreach $generos as $genero}
    <option value="{$genero->id_genero}">{$genero->nombre}</option>
{/foreach}
</select>
<button type="submit">Editar</button>
</form>
<a href="libros/{$libro->id_libro}/borrar"><button type="submit">Eliminar</button></a>
<form id="addComentario">
<div >
<label>Deja tu comentario</label>
<input type="text" name="comentario" id="comentario"/>
<label>Puntaje</label>
<input type="number" name="puntaje" id="puntaje"/>
<button type="submit">Enviar</button>
</div>
</form>
{/if}

<ul id="listaComentario">
</ul>

<script src="templates/js/scripts.js"></script>
{include file="footer.tpl"}