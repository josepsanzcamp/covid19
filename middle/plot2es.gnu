set terminal pngcairo size 1200,1200 enhanced font 'Segoe UI,10'
set output 'output/plot2es.png'
set multiplot layout 2,1 title "Defunciones por año y mes del MoMo y INE entre 2018 y 2020"
set rmargin 3
set grid
set auto x
set yrange [0:60000]
set style data histogram
set style fill solid border -1
set xtic rotate by -45 scale 0
set datafile separator ';'
set style histogram gap 3
plot [-0.5:14.5] 'middle/plot2es.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col
plot [14.5:29.5] 'middle/plot2es.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col
unset multiplot
