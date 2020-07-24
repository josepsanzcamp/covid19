set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set title "2. Defuncions per any i mes del MoMo i INE entre 2018 i 2020"
set rmargin 3
set grid
set auto x
set yrange [0:60000]
set style data histogram
set style fill solid border -1
set style histogram gap 3
set bmargin 3
set datafile separator ';'
set output 'output/plot2ca1.png'
plot [-0.5:11.5] 'middle/plot2ca.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col
set output 'output/plot2ca2.png'
plot [11.5:23.5] 'middle/plot2ca.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col
set output 'output/plot2ca3.png'
plot [23.5:35.5] 'middle/plot2ca.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col
