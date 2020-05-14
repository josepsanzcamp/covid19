# covid19
Aqui dejare algunos plots para mostrar los datos del MoMo y del INE

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

# Otros
- https://maldita.es/maldita-te-explica/2020/04/30/datos-fallecimientos-registro-civil-defunciones-diarias-causa-muerte/
- https://www.worldbank.org/

