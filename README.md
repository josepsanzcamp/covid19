# covid19
Plots para mostrar los datos del MoMo, INE, CSIC, OECD, EuroMoMo, Eurostat, ...
- Vigilancia de la Mortalidad Diaria (MoMo) => He obtenido los datos de mortalidad del 2020
- Instituto Nacional de Estadística (INE) => He obtenido los datos de defunciones de los registros civiles
- Envejecimiento en red (CSIC) => He obtenido los listados de resicencias
- Organisation for Economic Co-operation and Development (OECD) => He obtenido datos de otros paises
- EuroMoMo => He obtenido previsiones de mortalidad de otros paises de Europa
- Eurostat => Idem que lo anterior, pero con datos reales en lugar de la estimación que hace EuroMoMo
- Además, he obtenidos datos de Suecia, Noruega, Portugal, Francia y Alemania de sus respectivo instituto nacional de estadística

# MoMo
- https://www.isciii.es/QueHacemos/Servicios/VigilanciaSaludPublicaRENAVE/EnfermedadesTransmisibles/MoMo/Paginas/MoMo.aspx => pagina principal de MoMo
- https://cnecovid.isciii.es/covid19/ => COVID-19
- wget -O renave/agregados.$(date +"%Y%m%d").csv https://cnecovid.isciii.es/covid19/resources/agregados.csv
- wget -O renave/datos_ccaas.$(date +"%Y%m%d").csv https://cnecovid.isciii.es/covid19/resources/datos_ccaas.csv
- https://momo.isciii.es/public/momo/dashboard/momo_dashboard.html => panel de control de MoMo
- https://momo.isciii.es/public/momo/data => descarga directa del fichero csv con los datos de MoMo
- wget -O momo/data.$(date +"%Y%m%d").csv https://momo.isciii.es/public/momo/data

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
- https://cadenaser.com/ser/2020/07/16/sociedad/1594904807_835153.html => España alcanza su máximo histórico de envejecimiento
- https://www.ine.es/dynt3/inebase/index.htm?padre=2077&capsel=2077 => Indicadores de Estructura de la Población
- https://www.ine.es/jaxiT3/Tabla.htm?t=1451&L=0 => Proporción de personas mayores de cierta edad por comunidad autónoma
- https://www.ine.es/jaxiT3/Tabla.htm?t=1452&L=0 => Índice de Envejecimiento por comunidad autónoma
- https://www.ine.es/jaxiT3/Tabla.htm?t=3198&L=0 => Edad Media de la Población por comunidad autónoma, según sexo
- https://www.ine.es/jaxiT3/Tabla.htm?t=1726&L=0 => Edad Mediana de la Población por comunidad autónoma según sexo

# CSIC
- http://envejecimiento.csic.es/estadisticas/indicadores/residencias/index.html => Estadísticas sobre residencias
- http://envejecimiento.csic.es/recursos/residencias/por_provincia.html => Descarga gratuita de todas las residencias por provincia, formato xls 2019
- wget -O - -q http://envejecimiento.csic.es/recursos/residencias/por_provincia.html|tr '"' '\n'|grep 19_|gawk '{print "http://envejecimiento.csic.es"$0}'|xargs wget => Para descargar todos los excels
- http://envejecimientoenred.es/una-estimacion-de-la-poblacion-que-vive-en-residencias-de-mayores/ => Una estimación de la población que vive en residencias de mayores

# INDef
- https://www.mscbs.gob.es/ => Ministerio de Sanidad, Consumo y Bienestar Social
- https://www.mscbs.gob.es/sanidad/portada/home.htm => Sanidad
- https://www.mscbs.gob.es/estadEstudios/estadisticas/bancoDatos.htm => Banco de Datos
- https://www.mscbs.gob.es/estadEstudios/estadisticas/estadisticas/estMinisterio/IND_TipoDifusion.htm => Índice Nacional de Defunciones
- for i in $(seq 1 11); do wget https://www.mscbs.gob.es/estadEstudios/estadisticas/docs/indNacDefunciones/2020_Defunciones_$i.pdf; done
- for i in $(seq 1 11); do pdftotext -layout 2020_Defunciones_$i.pdf; done
- for i in $(seq 1 10); do wget https://www.mscbs.gob.es/estadEstudios/estadisticas/docs/indNacDefunciones/Defunciones_2019_$i.pdf; done
- for i in $(seq 1 10); do pdftotext -layout Defunciones_2019_$i.pdf; done

# OECD
- https://data.oecd.org/spain.htm
- https://data.oecd.org/healtheqt/hospital-beds.htm => Hospital beds
- https://data.oecd.org/healthres/nurses.htm => Nurses
- https://data.oecd.org/healthres/doctors.htm => Doctors
- https://stats.oecd.org/viewhtml.aspx?datasetcode=HEALTH_STAT&lang=en# => Para descargar la tabla de mortalidad por paises
- https://www.oecd-ilibrary.org/social-issues-migration-health/population/indicator/english_d434f82b-en => Para descargar los datos de poblacion por paises

# EuroMoMo
- https://www.euromomo.eu/graphs-and-maps => Datos de modtalidad de europa
- https://www.euromomo.eu/how-it-works/what-is-a-z-score => Importante para entender como vienen los datos normalizados
- wget https://www.euromomo.eu/component---src-templates-graphs-and-maps-js-cee79ce741871ab0f098.js => Fichero JavaScript que contiene los datos en un JSON
- wget -O euromomo/component.$(date +"%Y%m%d").js https://www.euromomo.eu$(wget -q -O - https://www.euromomo.eu/graphs-and-maps | tr '"' '\n' | grep /component---src-templates-graphs-and-maps-js | head -1)

# Eurostat
- https://www.destatis.de/Europa/EN/Topic/COVID-19/COVID-19-article.html
- https://www.destatis.de/Europa/EN/Topic/Population-Labour-Social-Issues/Demography-migration/mortality.html
- https://ec.europa.eu/eurostat/en/data/database?node_code=demo_mor
- https://ec.europa.eu/eurostat/en/data/database?node_code=demomwk
- wget -O eurostat/demo_r_mwk_ts.$(date +"%Y%m%d").tsv.gz "https://ec.europa.eu/eurostat/estat-navtree-portlet-prod/BulkDownloadListing?file=data/demo_r_mwk_ts.tsv.gz"

# Por paises
- https://magnet.xataka.com/en-diez-minutos/exceso-177-000-muertes-que-dicen-datos-momo-coronavirus-europa => Interpretacion de EuroMoMo
- https://www.destatis.de/EN/Press/2020/05/PE20_179_12621.html => Noticia en la Oficina Federal de Estadística de Alemánia

# Suécia
- https://www.scb.se/en/About-us/news-and-press-releases/highest-mortality-this-millennium-noted-in-sweden/ => Statistics Sweden
- https://www.scb.se/en/finding-statistics/statistics-by-subject-area/population/population-composition/population-statistics/pong/tables-and-graphs/preliminary-statistics-on-deaths/
- wget -O sweden/$(date +"%Y-%m-%d")-preliminar_statistik_over_doda_inkl_eng.xlsx https://www.scb.se/en/finding-statistics/statistics-by-subject-area/population/population-composition/population-statistics/pong/tables-and-graphs/preliminary-statistics-on-deaths/

# Noruega
- https://www.ssb.no/en/statbank/list/dode/ => Statistics Norway
- https://www.ssb.no/en/statbank/table/07995/ => 07995: Deaths, by sex, age and week. Preliminary figures 2000 - 2020
- wget -O norway/07995.$(date +"%Y%m%d").csv --post-data='{"query":[{"code":"Kjonn","selection":{"filter":"item","values":["0"]}},{"code":"Uke","selection":{"filter":"item","values":["U01","U02","U03","U04","U05","U06","U07","U08","U09","U10","U11","U12","U13","U14","U15","U16","U17","U18","U19","U20","U21","U22","U23","U24","U25","U26","U27","U28","U29","U30","U31","U32","U33","U34","U35","U36","U37","U38","U39","U40","U41","U42","U43","U44","U45","U46","U47","U48","U49","U50","U51","U52","U53"]}}],"response":{"format":"csv"}}' https://data.ssb.no/api/v0/en/table/07995/

# Portugal
- https://www.ine.pt/xportal/xmain?xpid=INE&xpgid=ine_base_dados
- https://www.ine.pt/xportal/xmain?contexto=bd&bdtemas=00&bdfreetext=death&bdind_por_pagina=15&xpid=INE&xpgid=ine_base_dados&bdpagenumber=1
- https://www.ine.pt/xportal/xmain?xpid=INE&xpgid=ine_indicadores&indOcorrCod=0010112&contexto=bd&selTab=tab2
- https://evm.min-saude.pt/ => SICO Vigilancia de mortalidade
- https://evm.min-saude.pt/#shiny-tab-q_total => Mortalidade geral
- wget -O portugal/Dados_SICO_$(date +"%Y-%m-%d").js "https://evm.min-saude.pt/table?t=geral&s=0"

# France
- https://www.insee.fr/en/statistiques
- https://www.insee.fr/en/statistiques/series/103039135?NATURE=2320650&ZONE_GEO=2227392
- https://www.insee.fr/en/statistiques?debut=0&categorie=5
- https://www.insee.fr/en/statistiques/4493808?sommaire=4493845
- wget -O france/$(date +"%Y-%m-%d")_detail.zip https://www.insee.fr/$(wget -q -O - "https://www.insee.fr/en/statistiques/4493808?sommaire=4493845"|tr '"' '\n'|grep _detail.zip)

# Alemania
- https://www.destatis.de/SiteGlobals/Forms/Suche/EN/Servicesuche_Formular.html?nn=23768&resourceId=2376&input_=23768&pageLocale=en&templateQueryString=daily+deaths&submit.x=0&submit.y=0
- https://www.destatis.de/EN/Themes/Society-Environment/Population/Deaths-Life-Expectancy/mortality.html
- https://www.destatis.de/EN/Themes/Cross-Section/Corona/_Graphic/_Interactive/deaths-weekly-years.html?nn=23768
- wget -O germany/sterbefallzahlen.$(date +"%Y%m%d").js "https://www.destatis.de/EN/Themes/Cross-Section/Corona/_Graphic/_Interactive/deaths-weekly-years.html?nn=23768&cms_showChartData=1"

# Spain
- https://www.ine.es/experimental/defunciones/experimental_defunciones.htm => Estimación del número de defunciones semanales durante el brote de covid-19
- https://www.ine.es/jaxiT3/Tabla.htm?t=35177 => Defunciones semanales, acumuladas y variación interanual del acumulado. Total nacional y CCAA. 2000-2020
- https://www.ine.es/jaxiT3/Tabla.htm?t=10803 => Defunciones por causas (lista reducida) por sexo y grupos de edad
- https://www.ine.es/jaxiT3/Tabla.htm?t=9936 => Defunciones por causas (lista reducida) por sexo
- https://www.ine.es/jaxi/Tabla.htm?path=/COVID/t15/&file=02003.px => Defunciones por año, enfermedades del sistema respiratorio y mes de defunción.
- wget -O spain/35177.$(date +"%Y%m%d").csv "https://www.ine.es/jaxiT3/files/t/es/csv_bdsc/35177.csv?nocab=1"

