{include file="header.tpl"}

{if $email }
<form method="POST" action="agregarGenero">
<input type="text" name="nombre"/>
<button type="submit">agregar</button>
</form>
{/if}

{foreach $generos as $genero}
<div><a href="generos/{$genero->id_genero}">{$genero->nombre}</a></div>
{/foreach}


{include file="footer.tpl"}