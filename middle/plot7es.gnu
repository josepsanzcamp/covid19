set terminal pngcairo size 1200,1200 enhanced font 'Segoe UI,10'
set output 'output/plot7es.png'
set multiplot layout 2,1 title "7. Relación de camas de hospital y enfermeras por país en 2016 segun datos OECD"
set rmargin 3
set grid
set auto x
set auto y
set style data histogram
set style fill solid border -1
set xtic rotate by -45 scale 0
set datafile separator ';'
set style histogram gap 3
plot 'middle/plot7es1.csv' u 2:xtic(1) ti col
plot 'middle/plot7es2.csv' u 2:xtic(1) ti col
unset multiplot
