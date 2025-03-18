@extends('layouts.userapp')

@section('content')
  <style>
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
    width: 157;
    max-width: 100%;
    margin-right: 15px;
    margin: 5px;
    height: 257px;
    object-fit: cover;
    vertical-align: baseline;
  }
  </style>

  <h1 class="title">Biografía</h1>
  <div id="content-area">
  <div id="node-781" class="node node-type-pagina">
    <div class="node-inner">

  <div class="content">
  <p>José Julián Martí Pérez nació en la calle Paula No. 41, La Habana, el 28 de enero de 1853. En 1866, matriculó en el
    Instituto de Segunda Enseñanza de La Habana. También ingresó en la clase de Dibujo Elemental en la Escuela Profesional
    de Pintura y Escultura de La Habana, más conocida como San Alejandro.</p>
  <p>El 4 de octubre de 1869, al pasar una escuadra del Primer Batallón de Voluntarios por la calle Industrias No. 122,
    donde residían los Valdés Domínguez, de la vivienda se oyen risas y los voluntarios toman esto como una provocación.
    Regresan en la noche y someten la casa a un minucioso registro. Entre la correspondencia encuentran una carta dirigida
    a Carlos de Castro y Castro, compañero del colegio que, por haberse alistado como voluntario en el ejército español
    para combatir a los independentistas, calificaban de apóstata.</p>
<div style="display: flex; align-items: flex-start;">
    <img class="image_biblio" src="{{ asset('catedra/bibliografia/005.jpg')}}" alt="Retrato de Martí al ser condenado a seis años de prisión por infidencia.">
    <div>
      <p style="text-align: justify;">
          Por tal razón, el 21 de octubre de 1869 Martí ingresa en la Cárcel Nacional acusado de infidencia por escribir esa carta, junto a su entrañable amigo Fermín Valdés Domínguez. El 4 de marzo de 1870, Martí fue condenado a seis años de prisión, pena posteriormente conmutada por el destierro a Isla de Pinos, lugar al que llega el 13 de octubre. El 18 de diciembre sale hacia La Habana y el 15 de enero de 1871, por gestiones realizadas por sus padres, logró ser deportado a España. Allá comienza a cursar estudios en las universidades de Madrid y Zaragoza, donde se gradúa de Licenciado en Derecho Civil y en Filosofía y Letras.
      </p>
      
      <div style="display: flex; align-items: flex-start;">
          <p style="text-align: justify; margin-right: 15px;">
              De España se traslada a París por breve tiempo. Pasa por Nueva York y llega a Veracruz el 8 de febrero de 1875, donde se reúne con su familia. En México entabla relaciones con Manuel Mercado y conoce a Carmen Zayas Bazán, la cubana que sería su esposa.
          </p>
          <img class="image_biblio" src="{{ asset('catedra/bibliografia/Manuel-Mercado.jpg')}}" alt="Imagen de Manuel Mercado" style="width: 157px; height: 260px; object-fit: cover;">
      </div>
  </div>
</div>

  </div>
  </div></div> <!-- /node-inner, /node -->
  </div>

@endsection