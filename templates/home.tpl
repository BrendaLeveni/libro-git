{include file="header.tpl"}

{if $email }
<label>Ingrese el nombre del genero:</label>
<form method="POST" action="agregarGenero">
<input type="text" name="nombre"/>
<button type="submit">Agregar</button>
</form>
{/if}
<ul class="lista">
{foreach $generos as $genero}
 <li ><a href="generos/{$genero->id_genero}">{$genero->nombre}</a></li>   
{/foreach}
</ul>


{include file="footer.tpl"}