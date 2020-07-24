set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set title "6. Plazas de residencias por tipo y comunidad autónoma (datos obtenidos de envejecimientoenred.es, del CSIC del 2019)"
set rmargin 3
set grid
set auto x
set auto y
set style data histogram
set style fill solid border -1
set xtic rotate by -45 scale 0
set style histogram gap 3
set datafile separator ';'
set output 'output/plot6es.png'
plot 'middle/plot6es.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col
