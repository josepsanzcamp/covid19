set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set title "6. Places de residències per tipus i comunitat autònoma (dades obtingudes de envejecimientoenred.es, del CSIC del 2019)"
set rmargin 3
set grid
set auto x
set auto y
set style data histogram
set style fill solid border -1
set xtic rotate by -45 scale 0
set style histogram gap 3
set datafile separator ';'
set output 'output/plot06ca.png'
plot 'middle/plot06ca.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col
