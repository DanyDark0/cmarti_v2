@extends('layouts.userapp')

@section('content')
    <style>
    .p {
      font-style: oblique
    }
    .clearfix::after {
    content: "";
    display: table;
    clear: both;
    }
    .content {
    text-align: justify; /* Justifica el texto */
    border-right: 5px solid #752e0f;/* Borde lateral café *//* Borde lateral café */
    padding: 20px; /* Espaciado interno */
    margin: 20px 0; /* Espacio arriba y abajo */
    border-radius: 10px; /* Bordes redondeados */
    box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }

    .title {
    color: #6F4E37; /* Color café para el título */
    font-weight: bold;
    text-align: center;
    margin-bottom: 15px;
    }
    .image_biblio {
    margin: 5px;
    object-fit: cover;
    vertical-align: baseline;
    }
    </style>

    <h1 class="title">Biografía</h1>

    <div class="content" style="max-width: 1000px; margin: auto;">
    <p>José Julián Martí Pérez nació en la calle Paula No. 41, La Habana, el 28 de enero de 1853. En 1866, matriculó en el 
      Instituto de Segunda Enseñanza de La Habana. También ingresó en la clase de Dibujo Elemental en la Escuela Profesional 
      de Pintura y Escultura de La Habana, más conocida como San Alejandro.</p>

    <p>El 4 de octubre de 1869, al pasar una escuadra del Primer Batallón de Voluntarios por la calle Industrias No. 122, 
      donde residían los Valdés Domínguez, de la vivienda se oyen risas y los voluntarios toman esto como una provocación. 
      Regresan en la noche y someten la casa a un minucioso registro. Entre la correspondencia encuentran una carta dirigida 
      a Carlos de Castro y Castro, compañero del colegio que, por haberse alistado como voluntario en el ejército español 
      para combatir a los independentistas, calificaban de apóstata.</p>

    <div style="overflow: hidden;">
        <div class="img-text">
        <img class="image_biblio" src="{{ asset('catedra/bibliografia/005.jpg') }}" 
        alt="Retrato de Martí al ser condenado a seis años de prisión por infidencia." 
        style="width: 150px; height: auto; float: left; margin-right: 15px;">
        </div>
      <p style="text-align: justify;">
      Por tal razón, el 21 de octubre de 1869 Martí ingresa en la Cárcel Nacional acusado de infidencia por escribir esa 
      carta, junto a su entrañable amigo Fermín Valdés Domínguez. El 4 de marzo de 1870, Martí fue condenado a seis años de 
      prisión, pena posteriormente conmutada por el destierro a Isla de Pinos, lugar al que llega el 13 de octubre. El 18 de 
      diciembre sale hacia La Habana y el 15 de enero de 1871, por gestiones realizadas por sus padres, logró ser deportado 
      a España. Allá comienza a cursar estudios en las universidades de Madrid y Zaragoza, donde se gradúa de Licenciado en 
      Derecho Civil y en Filosofía y Letras.
      </p>
      <p style="text-align: justify;">
      De España se traslada a París por breve tiempo. Pasa por Nueva York y llega a Veracruz el 8 de febrero de 1875, donde 
      se reúne con su familia. En México entabla relaciones con Manuel Mercado y conoce a Carmen Zayas Bazán, la cubana que 
      sería su esposa.
      </p>
    </div>

    <div style="overflow: hidden; margin-top: 20px;">
      <img class="image_biblio" src="{{ asset('catedra/bibliografia/Manuel-Mercado.jpg') }}" 
       alt="Imagen de Manuel Mercado" 
       style="width: 150px; height: auto; float: right; margin-left: 15px;">

      <p style="text-align: justify;">
      Del 2 de enero al 24 de febrero de 1877 estuvo de incógnito en La Habana como Julián Pérez. Al llegar a Guatemala
      trabaja en la Escuela Normal Central como catedrático de Literatura y de Historia de la Filosofía. Retorna a México,
      para contraer matrimonio con Carmen el 20 de diciembre de 1877, regresando a inicios de 1878 a Guatemala.
      </p>
      <div>
        <img class="image_biblio" src="{{ asset('catedra/bibliografia/05-Escuela-Normal-de-Varones-300x220.jpg') }}" 
       alt="Escuela Normal para Varones en Guatemala dirigida por el cubano José María Izaguirre." 
       style="width: 300px; height: 220px; float: left; margin-right: 15px;">

      <p>Concluida la Guerra del 68 vuelve a Cuba el 31 de agosto de 1878, para radicarse en La Habana, y el 22 de noviembre
      nace José
      Francisco, su único hijo. Comenzó sus labores conspirativas figurando entre los fundadores del Club Central
      Revolucionario Cubano, del cual fue elegido vicepresidente el 18 de marzo de 1879. Posteriormente el Comité
      Revolucionario Cubano, radicado en Nueva York bajo la presidencia del Mayor General Calixto García, lo nombró
      subdelegado en la Isla.
    </p>
    <p></p>
    <img class="image_biblio" src="{{ asset('catedra/bibliografia/004-214x300.jpg') }}" 
    alt="Carmen Zayas-Bazán y su hijo José Francisco." 
    style="width: 150px; height: auto; float: right; margin-left: 15px;">
    </div>
    </div>
    </div>



@endsection