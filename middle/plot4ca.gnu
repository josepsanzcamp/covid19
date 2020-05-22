set terminal pngcairo size 1200,1800 enhanced font 'Segoe UI,10'
set output 'output/plot4ca.png'
set multiplot layout 3,1 title "Defuncions per any, mes i edat (les dades de l'any 2020 són del MoMo i la resta són del INE)"
set rmargin 3
set grid
set auto x
set yrange [0:60000]
set style data histogram
set style fill solid border -1
set xtic rotate by -45 scale 0
set datafile separator ';'
set style histogram gap 3
plot [-0.5:11.5] 'middle/plot4ca.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col
plot [-0.5:11.5] 'middle/plot4ca.csv' using 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col
plot [-0.5:11.5] 'middle/plot4ca.csv' using 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col
unset multiplot
