set terminal png size 1200,600 enhanced font ',11'
set title "8. Defuncions per any i mes del MoMo segons la data de descarrega del fitxer de dades i diferencia entre cada fitxer"
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
set datafile separator ','
set colors classic
set output 'output/plot08ca1.png'
set xrange [-0.5:11.5]
plot 'middle/plot08ca.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col
set output 'output/plot08ca2.png'
set xrange [11.5:23.5]
plot 'middle/plot08ca.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col
set output 'output/plot08ca3.png'
set xrange [23.5:35.5]
plot 'middle/plot08ca.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col
set output 'output/plot08ca4.png'
set xrange [35.5:47.5]
plot 'middle/plot08ca.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col
set label 1 "Atenció: aquesta gràfica te l'escala diferent que la gràfica anterior del mateix grup" at 15.5,9000 c tc lt 1
set yrange [0:10000]
set ytics 0,2000,8000
set xtic rotate by -45
set output 'output/plot08ca5.png'
set xrange [3.5:27.5]
set bmargin 5
plot 'middle/plot08ca.csv' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col, '' u 14:xtic(1) ti col
