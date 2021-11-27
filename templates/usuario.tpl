{include file="header.tpl"}
<p>{$mensaje}</p>
{foreach $usuarios as $usuario}
 <li><a href="usuario/{$usuario->email}">{$usuario->email}</a></li>
 {if $usuario->administrador eq 1}
 <p>Es Admin</p>
 {/if}
 <form method="POST" action="modificarPermisos">
 <input name="usuario" value="{$usuario->id_usuario}" readonly>
 <button type="submit" >Modificar Permisos </button> 
 </form> 
 <a href="eliminarUsuario/{$usuario->id_usuario}"><button type="submit">Eliminar usuario </button></a>
 {/foreach}

{include file="footer.tpl"}