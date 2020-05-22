# covid19
Aqui dejare algunos plots para mostrar los datos del MoMo, del INE, del CSIC y del OECD
- Vigilancia de la Mortalidad Diaria (MoMo) => He sacado los datos de mortalidad del 2020
- Instituto Nacional de Estadística (INE) => He sacado los datos de defunciones de los registros civiles
- Envejecimiento en red (CSIC) => He sacado los listados de resicencias
- Organisation for Economic Co-operation and Development (OECD) => He sacado datos de otros paises

# MoMo
- https://www.isciii.es/QueHacemos/Servicios/VigilanciaSaludPublicaRENAVE/EnfermedadesTransmisibles/MoMo/Paginas/MoMo.aspx => pagina principal de MoMo
- https://momo.isciii.es/public/momo/dashboard/momo_dashboard.html => panel de control de MoMo
- https://momo.isciii.es/public/momo/data => descarga directa del fichero csv con los datos de MoMo
- https://cnecovid.isciii.es/covid19/ => COVID-19

# INE
- https://www.ine.es/buscar/searchResults.do?searchString=defunciones => Buscador desde donde he encontrado lo siguiente
- https://www.ine.es/jaxi/Tabla.htm?path=/COVID/t15/&file=02001.px => Defunciones por lugar de ocurrencia y edad. Años 2018 y 2019 (todos los meses)
- https://www.ine.es/dynt3/inebase/index.htm?padre=1132&capsel=1132 =>  Movimiento Natural de la Población: Defunciones
- https://www.ine.es/jaxiT3/Tabla.htm?t=7947 => Defunciones por causas (lista reducida) por sexo y grupos de edad
- https://www.ine.es/jaxiT3/Tabla.htm?t=6545 => Defunciones por lugar de residencia y sexo. Total nacional y provincias
- https://www.ine.es/jaxiT3/Tabla.htm?t=6548 => Defunciones por lugar de residencia, sexo y edad. Total nacional y comunidades autónomas
- https://www.ine.es/jaxiT3/Tabla.htm?t=6566 => Defunciones, matrimonios y nacimientos. Fenómenos demográficos por tipo de fenómeno demográfico
- https://www.ine.es/jaxiT3/Tabla.htm?t=6580 => Defunciones, matrimonios y nacimientos. Fenómenos demográficos por tipo de fenómeno demográfico
- https://www.ine.es/jaxiT3/Tabla.htm?t=14819 => Defunciones por causas (lista reducida) por sexo
- https://www.ine.es/jaxiT3/Tabla.htm?t=6561 => Defunciones por lugar de residencia. (Serie desde 1975). Total nacional y provincias
- https://www.ine.es/jaxiT3/Tabla.htm?t=6562 => Defunciones por lugar de residencia. (Serie desde 1975). Total nacional y comunidades autónomas
- https://www.ine.es/jaxi/Tabla.htm?path=/t20/e245/p08/&file=02002.px => Población por comunidades, edad (grupos quinquenales), Españoles/Extranjeros, Sexo y Año.
- https://www.ine.es/jaxi/Tabla.htm?path=/t20/e245/p04/provi/l0/&file=0ccaa003.px => Estadística del Padrón Continuo. Datos provisionales a 1 de enero de 2020
- https://www.ine.es/jaxiT3/Tabla.htm?t=9687 => Población residente por fecha, sexo y edad
- https://www.ine.es/dynt3/inebase/es/index.htm?type=pcaxis&path=/t20/e244/colectivos/p02/&file=pcaxis => Censos de Población y Viviendas 2011. Colectivos
- https://www.ine.es/jaxi/Tabla.htm?path=/t20/e244/colectivos/p02/l0/&file=02005.px => Población en establecimientos colectivos por sexo, edad (grupos quinquenales) y tipo de establecimiento colectivo
- https://www.ine.es/jaxi/Tabla.htm?path=/t20/e244/colectivos/p03/l0/&file=03001.px => Población en establecimientos colectivos por sexo y edad (año a año)
- https://www.ine.es/jaxi/Tabla.htm?path=/t20/e244/colectivos/p01/l0/&file=01001.px => Población en establecimientos colectivos según comunidad autónoma y provincia, por tipo de establecimiento colectivo (agrupado) y sexo
- https://www.ine.es/dyngs//INEbase/es/operacion.htm?c=Estadistica_C&cid=1254736177008&menu=resultados&idp=1254735573002 => Estadística de defunciones. Movimiento natural de la población
- https://www.ine.es/dyngs//INEbase/es/operacion.htm?c=Estadistica_C&cid=1254736177004&menu=resultados&idp=1254735573002 => Tablas de mortalidad

# CSIC
- http://envejecimiento.csic.es/estadisticas/indicadores/residencias/index.html => Estadísticas sobre residencias
- http://envejecimiento.csic.es/recursos/residencias/por_provincia.html => Descarga gratuita de todas las residencias por provincia, formato xls 2019
- wget -O - -q http://envejecimiento.csic.es/recursos/residencias/por_provincia.html|tr '"' '\n'|grep 19_|gawk '{print "http://envejecimiento.csic.es"$0}'|xargs wget => Para descargar todos los excels
- http://envejecimientoenred.es/una-estimacion-de-la-poblacion-que-vive-en-residencias-de-mayores/ => Una estimación de la población que vive en residencias de mayores

# OECD
- https://data.oecd.org/spain.htm
- https://data.oecd.org/healtheqt/hospital-beds.htm => Hospital beds
- https://data.oecd.org/healthres/nurses.htm => Nurses
- https://stats.oecd.org/viewhtml.aspx?datasetcode=HEALTH_STAT&lang=en# => Para descargar la tabla de mortalidad por paises
- https://www.oecd-ilibrary.org/social-issues-migration-health/population/indicator/english_d434f82b-en => Para descargar los datos de poblacion por paises


# Otros
- https://maldita.es/maldita-te-explica/2020/04/30/datos-fallecimientos-registro-civil-defunciones-diarias-causa-muerte/
- https://www.worldbank.org/
- https://github.com/search?q=covid19
- https://github.com/pomber/covid19
- https://pomber.github.io/covid19/timeseries.json

