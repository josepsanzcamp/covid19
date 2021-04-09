#!/bin/bash

cd $HOME/workspace/covid19.download

#~ wget -O renave/datos_ccaas.$(date +"%Y%m%d").csv https://cnecovid.isciii.es/covid19/resources/datos_ccaas.csv
wget -O momo/data.$(date +"%Y%m%d").csv https://momo.isciii.es/public/momo/data
wget -O euromomo/component.$(date +"%Y%m%d").js https://www.euromomo.eu$(wget -q -O - https://www.euromomo.eu/graphs-and-maps | tr '"' '\n' | grep /component---src-templates-graphs-and-maps-js | head -1)
wget -O eurostat/demo_r_mwk_ts.$(date +"%Y%m%d").tsv.gz "https://ec.europa.eu/eurostat/estat-navtree-portlet-prod/BulkDownloadListing?file=data/demo_r_mwk_ts.tsv.gz"
wget -O sweden/$(date +"%Y-%m-%d")-preliminar_statistik_over_doda_inkl_eng.xlsx https://www.scb.se/en/finding-statistics/statistics-by-subject-area/population/population-composition/population-statistics/pong/tables-and-graphs/preliminary-statistics-on-deaths/
wget -O norway/07995.$(date +"%Y%m%d").csv --post-data='{"query":[{"code":"Kjonn","selection":{"filter":"item","values":["0"]}},{"code":"Uke","selection":{"filter":"item","values":["U01","U02","U03","U04","U05","U06","U07","U08","U09","U10","U11","U12","U13","U14","U15","U16","U17","U18","U19","U20","U21","U22","U23","U24","U25","U26","U27","U28","U29","U30","U31","U32","U33","U34","U35","U36","U37","U38","U39","U40","U41","U42","U43","U44","U45","U46","U47","U48","U49","U50","U51","U52","U53"]}}],"response":{"format":"csv"}}' https://data.ssb.no/api/v0/en/table/07995/
wget -O portugal/Dados_SICO_$(date +"%Y-%m-%d").js "https://evm.min-saude.pt/table?t=geral&s=0"
wget -O france/$(date +"%Y-%m-%d")_detail.zip https://www.insee.fr/$(wget -q -O - "https://www.insee.fr/en/statistiques/4493808?sommaire=4493845"|tr '"' '\n'|grep _detail.zip)
wget -O germany/sterbefallzahlen.$(date +"%Y%m%d").js "https://www.destatis.de/EN/Themes/Cross-Section/Corona/_Graphic/_Interactive/deaths-weekly-years.html?nn=23768&cms_showChartData=1"
wget -O spain/35177.$(date +"%Y%m%d").csv "https://www.ine.es/jaxiT3/files/t/es/csv_bdsc/35177.csv?nocab=1"

gzip -nf */*.csv
gzip -nf */*.js

