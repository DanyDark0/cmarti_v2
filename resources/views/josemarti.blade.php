@extends('layouts.userapp')

@section('title', 'Cátedra José Martí | Bibliografía')
@section('content')
    <style>
    .text-imagen {
    color: gray; 
    font-size: 12px;
    }
    .content {
    text-align: justify; /* Justifica el texto */
    border-right: 5px solid #752e0f;/* Borde lateral café */ /* Borde lateral café */
    padding: 10px; /* Espaciado interno */
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

    <div class="content">
    <p>José Julián Martí Pérez nació en la calle Paula No. 41, La Habana, el 28 de enero de 1853. En 1866, matriculó en el 
    Instituto de Segunda Enseñanza de La Habana. También ingresó en la clase de Dibujo Elemental en la Escuela Profesional 
    de Pintura y Escultura de La Habana, más conocida como San Alejandro.</p>

    <p>El 4 de octubre de 1869, al pasar una escuadra del Primer Batallón de Voluntarios por la calle Industrias No. 122, 
    donde residían los Valdés Domínguez, de la vivienda se oyen risas y los voluntarios toman esto como una provocación. 
    Regresan en la noche y someten la casa a un minucioso registro. Entre la correspondencia encuentran una carta dirigida 
    a Carlos de Castro y Castro, compañero del colegio que, por haberse alistado como voluntario en el ejército español 
    para combatir a los independentistas, calificaban de apóstata.</p>

    <div style="overflow: hidden;">
    <div class="card" style="width: 160px; height: auto; float: left; margin-right: 15px;">
    <img class="image_biblio" src="{{ asset('catedra/bibliografia/005.jpg') }}" 
    alt="Retrato de Martí al ser condenado a seis años de prisión por infidencia." 
    style="width: 150px; height: auto; float: left; margin-right: 15px;">
      <div class="card-body">
      <p class="text-imagen">Retrato de Martí al ser condenado a seis años de prisión por infidencia.</p>
      </div>
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
    <div style="overflow: hidden">
    <div class="card"  style="width: 310px; height: auto; float: left; margin-right: 15px;">
    <img class="image_biblio" src="{{ asset('catedra/bibliografia/05-Escuela-Normal-de-Varones-300x220.jpg') }}" 
     alt="Escuela Normal para Varones en Guatemala dirigida por el cubano José María Izaguirre." 
     style="width: 300px; height: 220px; float: left; margin-right: 15px;">
     <div class="card-body">
    <p class="text-imagen">Escuela Normal para Varones en Guatemala dirigida por el cubano José María Izaguirre.</p>
     </div>
    </div>
    </div>
    </div>

    <p>Concluida la Guerra del 68 vuelve a Cuba el 31 de agosto de 1878, para radicarse en La Habana, y el 22 de noviembre
    nace José
    Francisco, su único hijo. Comenzó sus labores conspirativas figurando entre los fundadores del Club Central
    Revolucionario Cubano, del cual fue elegido vicepresidente el 18 de marzo de 1879. Posteriormente el Comité
    Revolucionario Cubano, radicado en Nueva York bajo la presidencia del Mayor General Calixto García, lo nombró
    subdelegado en la Isla.
    </p>
    <div>
    <div class="card" style="width: 160px; height: auto; float: right; margin-left: 15px;">
    <img class="image_biblio" src="{{ asset('catedra/bibliografia/004-214x300.jpg') }}" 
    alt="Carmen Zayas-Bazán y su hijo José Francisco." 
    style="width: 150px; height: auto; float: right; margin-right: 15px;">
    <div class="card-body">
      <p class="text-imagen">Carmen Zayas-Bazán y su hijo José Francisco.</p>
    </div>
    </div>
    <p>En el bufete de su amigo Don Nicolás Azcárate conoce a Juan Gualberto Gómez. Entre el 24 y el 26 de agosto de 1879 se
      produce un nuevo levantamiento en las cercanías de Santiago de Cuba. El 17 de septiembre Martí es detenido y deportado
      nuevamente a España, el 25 de septiembre de 1879, por sus vínculos en la Guerra Chiquita. Al llegar a Nueva York, se
      establece en la casa de huéspedes de Manuel Mantilla y su esposa, Carmen Miyares.</p>
    </div>

    <div style="overflow: hidden;">
    <div class="card" style="width: 160px; height: auto; float: left; margin-right: 15px;">
    <img class="image_biblio" src="{{ asset('catedra/bibliografia/0131.jpg') }}" 
    alt="Retrato de Martí al ser condenado a seis años de prisión por infidencia." 
    style="width: 150px; height: auto; float: left; margin-right: 15px;">
      <div class="card-body">
      <p class="text-imagen">Cincografía de Martí con su hijo José Francisco, fue hecha probablemente en New York, 1880.</p>
      </div>
    </div>
    <p style="text-align: justify;">
      Martí logra traer a su esposa e hijo el 3 de marzo de 1880. Permanecen juntos hasta el 21 de octubre, en que Carmen y José Francisco regresan a Cuba. Una semana después resultó electo vocal del Comité Revolucionario Cubano, del cual asumió la presidencia al sustituir a Calixto, quien había partido hacia Cuba para incorporarse a la Guerra Chiquita.
    </p>
    <p style="text-align: justify;">
      Entre 1880 y 1890 Martí alcanzaría renombre en la América a través de artículos y crónicas que enviaba desde Nueva York a importantes periódicos: La Opinión Nacional, de Caracas; La Nación, de Buenos Aires y El Partido Liberal, de México.
    </p>
    </div>

    <div>
    <div class="card" style="width: 160px; height: auto; float: right; margin-left: 15px;">
    <img class="image_biblio" src="{{ asset('catedra/bibliografia/020-Revista-Venezolana-178x300.jpg') }}" 
    alt="Carmen Zayas-Bazán y su hijo José Francisco." 
    style="width: 150px; height: auto; float: right; margin-right: 15px;">
    <div class="card-body">
      <p class="text-imagen">Solo tuvo dos números: el 1 de julio de 1881, con treinta dos páginas escritas por el propio Martí y el otro, con fecha del 15 de ese mes</p>
    </div>
    </div>
    <p>Posteriormente decide buscar mejor acomodo en Venezuela, a donde llega el 20 de enero de 1881. Fundó la Revista Venezolana, de la que pudo editar sólo dos números. Tras chocar con el caudillismo, tiene que retornar a Nueva York.</p>
    <p>A mediados de 1882 reinició la labor de reorganizar a los revolucionarios, comunicándoselo mediante cartas a Máximo Gómez y Antonio Maceo. El 2 de octubre de 1884 se reúne por vez primera con ambos líderes y comienza a colaborar en el Plan Insurreccional Gómez-Maceo; posteriormente desistió de su empeño por estar en desacuerdo con los métodos de dirección empleados.</p>
    </div>

    <div style="overflow: hidden;">
    <div class="card" style="width: 160px; height: auto; float: left; margin-right: 15px;">
    <img class="image_biblio" src="{{ asset('catedra/bibliografia/032-Patria-220x300.jpg') }}" 
    alt="Retrato de Martí al ser condenado a seis años de prisión por infidencia." 
    style="width: 150px; height: auto; float: left; margin-right: 15px;">
      <div class="card-body">
      <p class="text-imagen">Fundado y dirigido por José Martí, su oficina radicaba en Nueva York. El primer número salió el 14 de marzo de 1892 y desde entonces, hasta diciembre de 1898, en él se publicaron importantes trabajosCincografía de Martí con su hijo José Francisco, fue hecha probablemente en New York, 1880.</p>
      </div>
    </div>
    <p style="text-align: justify;">
      El 30 de noviembre de 1887 fundó una Comisión Ejecutiva, de la cual fue elegido presidente, encargada de dirigir las actividades organizativas de los revolucionarios. En enero de 1892 redactó lasBases y los Estatutos del Partido Revolucionario Cubano. El 8 de abril de 1892 resultó electo Delegado de esa organización, cuya constitución fue proclamada dos días después, el 10 de abril de 1892. El 14 de marzo fundó el periódico Patria, órgano oficial del Partido.
    </p>

    <div>
      <div class="card" style="width: 160px; height: auto; float: right; margin-left: 15px;">
      <img class="image_biblio" src="{{ asset('catedra/bibliografia/image.png') }}" 
      alt="Carmen Zayas-Bazán y su hijo José Francisco." 
      style="width: 150px; height: auto; float: right; margin-right: 15px;">
      <div class="card-body">
      <p class="text-imagen">Martí y el General Gómez en New York, 1894.</p>
      </div>
      </div>
      <p>En los años 1893 y 1894 recorrió varios países de América y ciudades de Estados Unidos, uniendo a los principales
      jefes de la Guerra del 68 y acopiando recursos para la nueva contienda. Desde mediados de 1894 aceleró los
      preparativos del Plan Fernandina, con el cual pretendía promover una guerra corta, sin grandes desgastes y
      destrucciones para los cubanos. El 8 de diciembre de 1894 redactó y firmó, conjuntamente con los coroneles
      MayíaRodríguez (en representación de Máximo Gómez) y Enrique Collazo (en representación de los patriotas de la Isla),
      el plan de alzamiento en Cuba. El Plan Fernandina fue descubierto e incautadas las naves con las cuales se iba a
      ejecutar. A pesar del gran revés que ello significó, Martí decidió seguir adelante con los planes de pronunciamientos
      armados en la Isla, en lo que fue apoyado por los principales jefes.</p>
      </div>
    </div>


    <div style="overflow: hidden;">
      <div class="card" style="width: 210px; height: auto; float: left; margin-right: 15px;">
      <img class="image_biblio" src="{{ asset('catedra/bibliografia/0013-Playita-270x300.jpg') }}" 
      alt="Retrato de Martí al ser condenado a seis años de prisión por infidencia." 
      style="width: 200px; height: auto; float: left; margin-right: 15px;">
        <div class="card-body">
        <p class="text-imagen">Lugar donde desembarcaron José Martí, Máximo Gómez y otros patriotas</p>
        </div>
      </div>
      <p style="text-align: justify;">
        El 29 de enero de 1895, junto con Mayíay Collazo, firmó la orden de alzamiento y la envió a Juan Gualberto Gómez para su ejecución. Partió de inmediato de Nueva York a Montecristi, en República Dominicana, donde lo esperaba Gómez, con quien firmó el 25 de marzo de 1895 un documento conocido como “Manifiesto de Montecristi”, programa de la nueva guerra. Ambos líderes llegan a Cuba el 11 de abril de 1895, por Playitas de Cajobabo, Baracoa.
      </p>
      <p>Tres días después del desembarco, hicieron contacto con las fuerzas del Comandante Félix Ruenes. El 15 de abril de 1895 los jefes allí reunidos bajo la dirección de Gómez, acordaron conferir a Martí el grado de Mayor General por sus méritos y servicios prestados.</p>
      <p>El 28 de abril de 1895, en el campamento de Vuelta Corta, en Guantánamo, en unión de Gómez firmó la circular “Política de guerra”. Envió mensajes a los jefes indicándoles que debían enviar un representante a una asamblea de delegados para elegir un gobierno en breve tiempo. El 5 de mayo de 1895 tuvo lugar su encuentro con Gómez y Maceo en La Mejorana, donde se discutió la estrategia a seguir. El 14 de mayo de 1895 firmó la “Circular a los jefes y oficiales del Ejército Libertador”, último de los documentos organizativos de la guerra, la que elaboró conjuntamente con Máximo Gómez.</p>
      </div>
      <p>Siguiendo la marcha hacia el oeste de la provincia oriental, llegaron a Dos Ríos, cerca de Palma Soriano. El 19 de mayo de 1895 una columna española se desplegó en la zona y los cubanos fueron a su encuentro. Martí marchaba entre Gómez y el Mayor General Bartolomé Masó.</p>

      <div style="overflow: hidden;">
        <div class="card" style="width: 310px; height: auto; float: left; margin-right: 15px;">
        <img class="image_biblio" src="{{ asset('catedra/bibliografia/0012-Dos-Rios-300x218.jpg') }}" 
        alt="Retrato de Martí al ser condenado a seis años de prisión por infidencia." 
        style="width: 300px; height: auto; float: left; margin-right: 15px;">
          <div class="card-body">
          <p class="text-imagen">Dos Ríos: Lugar donde cae en combate José Martí, el 19 de mayo de 1895.</p>
          </div>
        </div>
        <p style="text-align: justify;">
          Al llegar al lugar de la acción, Gómez le indicó detenerse y permanecer en el lugar acordado. No obstante, en el
          transcurso del combate, se separó del grueso de las fuerzas cubanas, acompañado solamente por su ayudante Ángel de la
          Guardia. Martí cabalgó, sin saberlo, hacia un grupo de españoles ocultos en la maleza y fue alcanzado por tres disparos
          que le provocaron heridas mortales. Cuando se conoció lo sucedido, resultó imposible rescatar su cadáver, el cual fue
          conducido por los españoles y, tras varios enterramientos, fue finalmente sepultado el día 27, en el nicho número 134 de
          la galería sur del Cementerio de Santa Ifigenia, en Santiago de Cuba.
        </p>
        </div>
  </div>

@endsection