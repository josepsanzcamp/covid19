set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set output 'output/plot6ca.png'
set multiplot layout 1,1 title "Places de residències per tipus i comunitat autònoma (dades obtingudes de envejecimientoenred.es, del CSIC del 2019)"
set rmargin 3
set grid
set auto x
set auto y
set style data histogram
set style fill solid border -1
set xtic rotate by -45 scale 0
set datafile separator ';'
set style histogram gap 3
plot 'middle/plot6ca.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col
unset multiplot
