set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set title "6. Places of residences by type and autonomous community (data obtained from envejecimientoenred.es, from the CSIC of 2019)"
set rmargin 3
set grid
set auto x
set auto y
set style data histogram
set style fill solid border -1
set xtic rotate by -45 scale 0
set style histogram gap 3
set datafile separator ';'
set output 'output/plot6en.png'
plot 'middle/plot6en.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col
