set terminal png size 1200,600 enhanced font ',10'
set title "6. Places of residences by type and autonomous community (data obtained from envejecimientoenred.es, from the CSIC of 2019)"
set grid
set tmargin 3
set rmargin 6
set bmargin 7
set lmargin 6
set auto x
set auto y
set style data histogram
set style fill solid border -1
set xtic rotate by -45
set style histogram gap 3
set yrange [0:70000]
set ytic center rotate by 90
set ytics 0,10000,60000
set datafile separator ';'
set output 'output/plot06en.png'
plot 'middle/plot06en.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col
