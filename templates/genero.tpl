{include file="header.tpl"}

<h1>{$genero->nombre}</h1>
<h2>Libros de este genero</h2>
<ul>
{foreach $libros as $libro}
 <li><a href="libros/{$libro->id_libro}">{$libro->titulo}</a></li>   
{/foreach}
</ul>

{if $email }
<form method="POST" action="generos/{$genero->id_genero}/editar">
<input type="text" name="nombre" value="{$genero->nombre}"/>
<button type="submit">Editar</button>
</form>
<a href="generos/{$genero->id_genero}/borrar"><button type="submit">borrar</button></a>
{/if}

{include file="footer.tpl"}