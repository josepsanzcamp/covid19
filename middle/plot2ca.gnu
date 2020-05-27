set terminal pngcairo size 1200,1200 enhanced font 'Segoe UI,10'
set output 'output/plot2ca.png'
set multiplot layout 2,1 title "Defuncions per any i mes del MoMo i INE entre 2018 i 2020"
set rmargin 3
set grid
set auto x
set yrange [0:60000]
set style data histogram
set style fill solid border -1
set xtic rotate by -45 scale 0
set datafile separator ';'
set style histogram gap 3
plot [-0.5:14.5] 'middle/plot2ca.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col
plot [14.5:29.5] 'middle/plot2ca.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col
unset multiplot
