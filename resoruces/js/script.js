window.addEventListener('load', () => {



    // Variables
    const btn_redactar = document.querySelector('.btn-redactar > button');

    const contenedor_mensaje = document.querySelector('.redactar-msg');
    const btns_header_contenedor_mensaje = document.querySelectorAll('.botones > i');

    const mensajes = document.querySelector('header .mensajes .cantidad');

    const menu_usuario = document.querySelector('.menu-usuario');
    const btn_menu_usuario = document.querySelector('.usuario');

    // variables mensajeria, no leidos y enviados
    const mensajeria = document.querySelector('#mensajeria');
    const no_leidos = document.querySelector('#no-leidos');
    const enviados = document.querySelector('#enviados');
    const contenedor = document.querySelector('#contenedor');
    const titulo = document.querySelector('.container-fluid .titulo');

    const campo_para = document.querySelector('#para');
    const resultados = document.querySelector('.resultados');

    // variables de cajon enviar mensaje
    const form_mensaje = document.getElementById('enviar-mensaje');

    // varaibles del session
    const form_datos_usuario = document.getElementById('datos_usuario');
    let id = form_datos_usuario.children['id'].value;
    let usuario = form_datos_usuario.children['usuario'].value;
    let nombre = form_datos_usuario.children['nombre'].value;


    // Events Listener

    btn_menu_usuario.addEventListener('click', () => {
        men_usr.action();
    })

    btn_redactar.addEventListener('click', e => {
        contenedor_mensaje.style.display = 'block';
        e.target.disabled = true;
    });

    btns_header_contenedor_mensaje[1].addEventListener('click', () => {
        contenedor_mensaje.style.display = 'none';
        btn_redactar.disabled = false;
    });

    btns_header_contenedor_mensaje[0].addEventListener('click', () => {
        if (contenedor_mensaje.style.height == '36px') {
            contenedor_mensaje.style.height = '500px';
        } else {
            contenedor_mensaje.style.height = '36px';
        }
    });

    function template(){
        $.ajax({
            url: "mensajeria.php",
            success: function (response) {
                $(contenedor).html(response);
            }
        });
    }

    mensajeria.addEventListener('click', () => {
        template();
        fetch_mensaje();
        titulo.innerText = 'Mensajeria';
    });

    no_leidos.addEventListener('click', () => {
        template();
        fetch_mensaje_no_leidos();
        titulo.innerText = 'No leidos';
    });

    enviados.addEventListener('click', () => {
        template();
        fetch_mensaje_enviados();
        titulo.innerText = 'Enviados'; 
    });

    campo_para.addEventListener('keyup', () => {
        let search = campo_para.value;
        while (resultados.firstChild) {
            resultados.removeChild(resultados.firstChild)
        }
        if (search != "") {
            $.ajax({
                url: "php/search-user.php",
                type: "POST",
                data: { search },
                success: function (response) {
                    let users = JSON.parse(response);
                    let template = '';
                    users.forEach(user => {
                        template += `<li>
                            ${user.usuario}
                        </li>`;
                        resultados.innerHTML = template;
                    });
                    resultados.childNodes.forEach(d => {
                        d.addEventListener('click', de => {
                            campo_para.value = de.target.innerText;
                            while (resultados.firstChild) {
                                resultados.removeChild(resultados.firstChild)
                            }
                        })
                    });
                }
            });
        }

    });

    // 2020-11-11 13:49:51


    function calcularTiempo(tiempo) {
        let regex = /(\d+)/g;
        let tiempoTransofmado = tiempo.match(regex);
        let TS = {
            anio: tiempoTransofmado[0],
            mes: tiempoTransofmado[1] - 1,
            dia: tiempoTransofmado[2],
            hora: tiempoTransofmado[3],
            minuto: tiempoTransofmado[4],
            segundo: tiempoTransofmado[5]
        };

        let tiempoCapturado = new Date(
            TS.anio,
            TS.mes,
            TS.dia,
            TS.hora,
            TS.minuto,
            TS.segundo
        );

        let tiempoActual = new Date();

        let total = (tiempoActual - tiempoCapturado);

        if (Math.round(total / 3600000 * 60 * 60) <= 60) {
            return Math.round(total / 3600000 * 60 * 60) + " Seg";

        } else if (Math.round(total / 3600000 * 60 <= 60)) {
            return Math.round(total / 3600000 * 60) + " Min";

        } else if (Math.round(total / 3600000) <= 24) {
            if (Math.round(total / 3600000) <= 1) {
                return Math.round(total / 3600000) + " Hora";

            } else {
                return Math.round(total / 3600000) + " Horas";

            }

        } else if (Math.round(total / 3600000 / 24) <= 31) {
            if (Math.round(total / 3600000 / 24) <= 1) {
                return Math.round(total / 3600000 / 24) + " Dia";

            } else {
                return Math.round(total / 3600000 / 24) + " Dias";

            }

        } else {
            return tiempo;
        }

        // return Math.round((tiempoActual - tiempoCapturado) / (3600000/60)) + " Min";
    }

    calcularTiempo('2020-11-11 13:49:51');


    // let tiempo = new Date(2020,11,11,13,49,51);
    // console.log(tiempo);

    form_mensaje.addEventListener('submit', e => {

        const postData = {
            destinario: $('#para').val(),
            remitente: usuario,
            mensaje: $('.texto-mensaje').text()
        }


        $.post("php/enviar-mensaje.php", postData,
            function (response) {
                // console.log(response);$('#para').val('');
                $('#para').val('');
                $('.texto-mensaje').text('');
                
                mostrar_enviados();
                fetch_mensaje_enviados()
            }
        );

        e.preventDefault();




    });

    // Funciones

    let men_usr = {
        estado: false,
        action() {
            if (this.estado) {
                menu_usuario.style.height = '0px';
                this.estado = false;
            } else {
                menu_usuario.style.height = '300px';
                this.estado = true;
            }
        }
    }

    function fetch_mensaje() {

        $.ajax({
            url: "php/listar-mensajes.php",
            type: "POST",
            data: { usuario },
            success: function (response) {
                let mensajes = JSON.parse(response);
                let template = '';
                mensajes.forEach(mensaje => {
                    let estado = 'No Leido';
                    if (mensaje.estado != 0) {
                        estado = 'Leido';
                    } else {
                        estado = 'No leido';
                    }

                    template += `
                    <tr data-remitente="${mensaje.id}" id="btn-ver-mensaje">
                        <td>${mensaje.remitente}</td>
                        <td>${mensaje.mensaje}</td>
                        <td>${estado}</td>
                        <td>${calcularTiempo(mensaje.hora)}</td>
                    </tr>
                    `;
                    $('.datos-mensajeria').html(template);
                });
                let trs = document.querySelectorAll('#btn-ver-mensaje');
                trs.forEach(tr => {
                    tr.addEventListener('click', () => {
                        ver_mensaje(tr.getAttribute('data-remitente'));
                    })
                });
            }
        });
    }

    function fetch_mensaje_no_leidos() {

        $.ajax({
            url: "php/listar-mensajes-no-leidos.php",
            type: "POST",
            data: { usuario },
            success: function (response) {
                let mensajes = JSON.parse(response);
                let template = '';
                mensajes.forEach(mensaje => {
                    let estado = 'No Leido';
                    if (mensaje.estado != 0) {
                        estado = 'Leido';
                    } else {
                        estado = 'No leido';
                    }

                    template += `
                    <tr data-remitente="${mensaje.id}" id="btn-ver-mensaje">
                        <td>${mensaje.remitente}</td>
                        <td>${mensaje.mensaje}</td>
                        <td>${estado}</td>
                        <td>${calcularTiempo(mensaje.hora)}</td>
                    </tr>
                    `;
                    $('.datos-mensajeria').html(template);
                });
                let trs = document.querySelectorAll('#btn-ver-mensaje');
                trs.forEach(tr => {
                    tr.addEventListener('click', () => {
                        ver_mensaje(tr.getAttribute('data-remitente'));
                    })
                });
            }
        });
    }

    function fetch_mensaje_enviados() {

        $.ajax({
            url: "php/listar-mensajes-enviados.php",
            type: "POST",
            data: { usuario },
            success: function (response) {
                let mensajes = JSON.parse(response);
                let template = '';
                mensajes.forEach(mensaje => {
                    let estado = 'No Leido';
                    if (mensaje.estado != 0) {
                        estado = 'Leido';
                    } else {
                        estado = 'No leido';
                    }

                    template += `
                    <tr data-remitente="${mensaje.id}" id="btn-ver-mensaje">
                        <td>${mensaje.remitente}</td>
                        <td>${mensaje.destinario}</td>
                        <td>${mensaje.mensaje}</td>
                        <td>${calcularTiempo(mensaje.hora)}</td>
                    </tr>
                    `;
                    $('.datos-mensajeria').html(template);
                });
                let trs = document.querySelectorAll('#btn-ver-mensaje');
                trs.forEach(tr => {
                    tr.addEventListener('click', () => {
                        ver_mensaje(tr.getAttribute('data-remitente'));
                    })
                });
            }
        });
    }

    function ver_mensaje(id) {

        $.ajax({
            url: "php/obtener-mensaje.php",
            type: "POST",
            data: { id },
            success: function (response) {
                let mensajes = JSON.parse(response);
                let template = '';
                mensajes.forEach(mensaje => {
                    template += `
                    <div class="contenido-mensaje mt-4 pt-3 pb-3">
                        <div class="remitente pb-3">
                            <b>Enviado por: ${mensaje.remitente}.</b>
                            <p>Para: ${mensaje.destinario}</p>
                        </div>
                        <div class="mensaje-recibido">
                            ${mensaje.mensaje}
                        </div>
                    </div>
                    `;
                });

                $('.contenido-mensaje').html(template);
            }
        });

        marcar_como_leido(id);
    }

    function marcar_como_leido(id) {
        $.ajax({
            url: "php/marcar-leido.php",
            type: "POST",
            data: { id },
            success: function (response) {
                
            }
        });
    }

    function caputar_estado(estado) {
        $.ajax({
            url: "php/capturar-estado.php",
            type: "POST",
            data: { estado, usuario },
            success: function (response) {

                if (estado == 0) {
                    no_leidos.children[1].innerText = response;
                    if (response < 10) {
                        mensajes.innerText = response;
                    } else {
                        mensajes.innerText = '9+';
                    }
                }


            }
        });
    }


    function todos_los_mensajes() {
        $.ajax({
            url: "php/mensajes-totales.php",
            type: "POST",
            data: { usuario },
            success: function (response) {

                mensajeria.children[1].innerText = response;

            }
        });
    }

    function mostrar_enviados() {
        $.ajax({
            url: "php/capturar-enviados.php",
            type: "POST",
            data: { usuario },
            success: function (response) {

                enviados.children[1].innerText = response;

            }
        });
    }

    caputar_estado(0);
    fetch_mensaje();
    todos_los_mensajes();
    mostrar_enviados();


});