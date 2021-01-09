set terminal png size 1200,600 enhanced font ',11'
set title "2. Defunciones por año y mes del MoMo y INE entre 2018 y 2021"
set grid
set tmargin 3
set rmargin 6
set bmargin 3
set lmargin 6
set auto x
set yrange [0:60000]
set style data histogram
set style fill solid border -1
set style histogram gap 3
set ytic center rotate by 90
set ytics 0,10000,50000
set datafile separator ';'
set colors classic
set output 'output/plot02es1.png'
set xrange [-0.5:11.5]
plot 'middle/plot02es.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col
set output 'output/plot02es2.png'
set xrange [11.5:23.5]
plot 'middle/plot02es.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col
set output 'output/plot02es3.png'
set xrange [23.5:35.5]
plot 'middle/plot02es.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col
set output 'output/plot02es4.png'
set xrange [35.5:47.5]
plot 'middle/plot02es.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col
