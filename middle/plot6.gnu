set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set output 'output/plot6.png'
set multiplot layout 1,1 title 'Plazas de residencias por tipo y comunidad autónoma (datos obtenidos de envejecimientoenred.es, del CSIC del 2019)'
set rmargin 3
set grid
set auto x
set yrange [0:90000]
set style data histogram
set style fill solid border -1
set xtic rotate by -45 scale 0
set datafile separator ';'
set style histogram gap 3
plot 'middle/plot6.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col
unset multiplot
