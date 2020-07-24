set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set title "8. Defunciones por año i mes del MoMo según la fecha de descarga del fichero de datos y diferencia entre cada fichero"
set rmargin 3
set grid
set auto x
set yrange [0:60000]
set style data histogram
set style fill solid border -1
set style histogram gap 3
set bmargin 3
set datafile separator ';'
set output 'output/plot8es1.png'
plot [-0.5:13.5] 'middle/plot8es.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col
set output 'output/plot8es2.png'
plot [13.5:27.5] 'middle/plot8es.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col
set label 1 "Atención: esta gráfica tiene la escala diferente que la gráfica anterior del mismo grupo" at 12,9000 c tc lt 1
set yrange [0:10000]
set xtic rotate by -45 scale 0
unset bmargin
set output 'output/plot8es3.png'
plot [0.5:24.5] 'middle/plot8es.csv' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col
