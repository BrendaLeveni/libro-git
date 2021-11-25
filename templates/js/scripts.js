"use strict";

document.addEventListener("DOMContentLoaded", (e) => {

    let url = 'api/comentario/';

    let id = window.location.pathname.substr(window.location.pathname.lastIndexOf('/') + 1);

    async function getComentarios() {
        let req = await fetch(url + id);
        let res = await req.json();
        cargaComentarios(res);
    }

    function cargaComentarios(array) {

        let ul = document.querySelector("#listaComentario");
        ul.innerHTML = "";
        array.forEach(comentario => {
            ul.innerHTML += `<li>${comentario.comentario}, ${comentario.puntaje}, ${comentario.fecha}`;
            if (document.querySelector("body").dataset.admin == 1) {
                ul.innerHTML += `<button class="eliminar" data-id="${comentario.id_comentario}">Eliminar</button>`
            }
            ul.innerHTML += "</li>";
        });
        let botones = document.querySelectorAll(".eliminar");
        if (botones) {
            botones.forEach(boton => {
                boton.addEventListener("click", borrarComentario);
            });
        }
    }
    getComentarios();

    let form = document.querySelector("#addComentario");
    if (form) {
        form.addEventListener("submit", agregarComentario);
    }
    async function agregarComentario(e) {
        e.preventDefault();
        let comentario = {
            "comentario": document.querySelector("#comentario").value,
            "puntaje": document.querySelector("#puntaje").value
        };
        let req = await fetch(url + id, {
            method: 'POST',
            header: { 'Content-Type': 'Application/Json' },
            body: JSON.stringify(comentario)
        });
        let res = await req.json();
        getComentarios();
    }
   
    async function borrarComentario(e) {
            let id_comentario = e.target.dataset.id;
            let req = await fetch(url + id + "/" + id_comentario, {
                method : "DELETE"
            });
            let res = await req.json();
            getComentarios();
    }

});





