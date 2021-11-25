{include file="header.tpl"}
{foreach $usuarios as $usuario}
 <li><a href="usuario/{$libro->id_libro}">{$libro->titulo}</a></li>
 <button type="submit">Eliminar usuario </button> 
 <button type="submit">Modificar Permisos </button> 







{include file="footer.tpl"}