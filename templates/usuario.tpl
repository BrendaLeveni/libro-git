{include file="header.tpl"}
{foreach $usuarios as $usuario}
 <li><a href="usuario/{$usuario->email}">{$usuario->email}</a></li>
 <button type="submit">Eliminar usuario </button> 
 <button type="submit">Modificar Permisos </button> 
 {{/foreach}}







{include file="footer.tpl"}