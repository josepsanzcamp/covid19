set terminal pngcairo size 1200,1800 enhanced font 'Segoe UI,10'
set output 'output/plot8ca.png'
set multiplot layout 3,1 title "Defuncions per any i mes del MoMo segons la data de descarrega del fitxer de dades i diferencia entre cada fitxer"
set rmargin 3
set grid
set auto x
set yrange [0:60000]
set style data histogram
set style fill solid border -1
set xtic rotate by -45 scale 0
set datafile separator ';'
set style histogram gap 3
plot [-0.5:13.5] 'middle/plot8ca.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col
plot [13.5:27.5] 'middle/plot8ca.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col
set label 1 "Atenció: aquesta gràfica te l'escala diferent que la gràfica anterior del mateix grup" at 12,9000 c tc lt 1
set yrange [0:10000]
plot [0.5:24.5] 'middle/plot8ca.csv' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col
unset multiplot
