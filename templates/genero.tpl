{include file="header.tpl"}

<h1>{$genero->nombre}</h1>
<h2>Libros de este genero</h2>
<ul class="lista">
{foreach $libros as $libro}
 <li><a href="libros/{$libro->id_libro}">{$libro->titulo}</a></li>   
{/foreach}
</ul>

{if $email }
<form method="POST" action="generos/{$genero->id_genero}/editar">
<label>Genero:</label>
<input type="text" name="nombre" value="{$genero->nombre}"/>
<button type="submit">Editar</div></button>
</form>
<a href="generos/{$genero->id_genero}/borrar"><button type="submit">Borrar</button></a>
{/if}

{include file="footer.tpl"}