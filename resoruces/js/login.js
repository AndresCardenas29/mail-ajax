window.addEventListener('load', () => {
    const btn_registro = document.querySelector('#registro');
    const contenedor_registro = document.querySelector('.registro');
    const btn_regresar = document.querySelector('.regresar');

    btn_registro.addEventListener('click', () => {
        contenedor_registro.style.display = 'flex';
    });

    btn_regresar.addEventListener('click', () => {
        contenedor_registro.style.display = 'none';
    });
});