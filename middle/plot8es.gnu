set terminal pngcairo size 1200,1200 enhanced font 'Segoe UI,10'
set output 'output/plot8es.png'
set multiplot layout 2,1 title "Defunciones por año i mes del MoMo según la fecha de descarga del fichero de datos"
set rmargin 3
set grid
set auto x
set yrange [0:60000]
set style data histogram
set style fill solid border -1
set xtic rotate by -45 scale 0
set datafile separator ';'
set style histogram gap 3
plot [-0.5:13.5] 'middle/plot8es.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col
plot [13.5:27.5] 'middle/plot8es.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col
unset multiplot
