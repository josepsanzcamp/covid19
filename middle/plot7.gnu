set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set output 'output/plot7.png'
set multiplot layout 1,1 title 'Relacion de camas de hospital y enfermeras por país en 2016 segun datos OECD'
set rmargin 3
set grid
set auto x
set auto y
set style data histogram
set style fill solid border -1
set xtic rotate by -45 scale 0
set datafile separator ';'
set style histogram gap 3
plot [-0.5:17.5] 'middle/plot7.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col
unset multiplot
