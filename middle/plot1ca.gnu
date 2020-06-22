set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set title "1. Defuncions per any i mes (només anys on algun mes ha superat els 40k morts, les dades de l'any 2020 són del MoMo i la resta són del INE)"
set rmargin 3
set grid
set auto x
set yrange [0:60000]
set style data histogram
set style fill solid border -1
set xtic rotate by -45 scale 0
set style histogram gap 3
set datafile separator ';'
set output 'output/plot1ca1.png'
plot [-0.5:5.5] 'middle/plot1ca.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col
set output 'output/plot1ca2.png'
plot [5.5:11.5] 'middle/plot1ca.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col
