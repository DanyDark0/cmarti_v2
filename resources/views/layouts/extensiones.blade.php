<style>
.view-content-ext {
    display: flex;
    flex-wrap: wrap; /* Permite que las imágenes se acomoden en varias líneas si es necesario */
    justify-content: center;
    gap: 15px; /* Espacio entre columnas */
    padding: 20px;
    background-color: #f8f8f8;
    border-radius: 10px;
    margin: auto;
    max-width: 100%;
}

.views-view-grid-ext {
    width: 100%;
    max-width: 960px;
    border-collapse: collapse;
    table-layout: fixed; /* Fuerza a que las columnas tengan el mismo tamaño */
}

.row-ext {
    display: table-row; /* Asegura que todo esté en una línea */
}

.col-ext {
    flex: 1 1 230px;
    max-width: 230px; /* Máximo tamaño de la imagen */
    min-width: 120px; /* Mínimo tamaño para que no se encojan demasiado */
    text-align: center;
    padding: 10px;
}

.image-banner-ext {
    width: 100%;
    height: 80px;
    max-width: 100%; /* No sobrepasará el tamaño del contenedor */
    border-radius: 8px;
    transition: transform 0.3s ease-in-out;
}

.image-banner-ext:hover {
    transform: scale(1.1);
}

/* Ajuste para pantallas pequeñas */
@media (max-width: 768px) {
    .view-content-ext {
        flex-direction: row; /* Apila las imágenes en columnas en móviles */
        flex-wrap: wrap;
        align-items: center;
    }
    .col-ext {
        flex: 1 1 45vw;
        max-width: 180px; /* Ocupará todo el ancho en pantallas pequeñas */
    }
}

</style>
<div class="view-content-ext">
    <table class="views-view-grid-ext">
        <tbody>
            <tr class="row-ext">
                <td class="col-ext">
                    <a href="http://www.udg.mx" target="_blank">
                        <img src="http://cmarti.cucsh.udg.mx/sites/default/files/images/udg_0.jpg" 
                            alt="udg" title="udg" class="image-banner-ext" />
                    </a>
                </td>
                <td class="col-ext">
                    <a href="http://www.cucsh.udg.mx" target="_blank">
                        <img src="http://cmarti.cucsh.udg.mx/sites/default/files/images/cucsh_0.jpg" 
                            alt="cucsh" title="cucsh" class="image-banner-ext" />
                    </a>
                </td>
                <td class="col-ext">
                    <a href="http://www.cmarti.cucsh.udg.mx" target="_blank">
                        <img src="http://cmarti.cucsh.udg.mx/sites/default/files/images/cemh_0.jpg" 
                            alt="cemh" title="cemh" class="image-banner-ext" />
                    </a>
                </td>
                <td class="col-ext">
                    <a href="http://www.redmartiana.cucsh.udg.mx" target="_blank">
                        <img src="http://cmarti.cucsh.udg.mx/sites/default/files/images/banner%20CM.jpg" 
                            alt="banner CM" title="banner CM" class="image-banner-ext" />
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
