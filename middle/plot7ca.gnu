set terminal pngcairo size 1200,1200 enhanced font 'Segoe UI,10'
set output 'output/plot7ca.png'
set multiplot layout 2,1 title "Relació de llits de hospital i infermeres per país en 2016 segons dades OECD"
set rmargin 3
set grid
set auto x
set auto y
set style data histogram
set style fill solid border -1
set xtic rotate by -45 scale 0
set datafile separator ';'
set style histogram gap 3
plot 'middle/plot7ca1.csv' u 2:xtic(1) ti col
plot 'middle/plot7ca2.csv' u 2:xtic(1) ti col
unset multiplot
