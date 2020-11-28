set terminal png size 1200,600 enhanced font ',10'
set title "8. Defunciones por año i mes del MoMo según la fecha de descarga del fichero de datos y diferencia entre cada fichero"
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
set output 'output/plot08es1.png'
set xrange [-0.5:11.5]
plot 'middle/plot08es.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col
set output 'output/plot08es2.png'
set xrange [11.5:23.5]
plot 'middle/plot08es.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col
set output 'output/plot08es3.png'
set xrange [23.5:35.5]
plot 'middle/plot08es.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col
set label 1 "Atención: esta gráfica tiene la escala diferente que la gráfica anterior del mismo grupo" at 15.5,9000 c tc lt 1
set yrange [0:10000]
set ytics 0,2000,8000
set xtic rotate by -45
set output 'output/plot08es4.png'
set xrange [3.5:27.5]
set bmargin 5
plot 'middle/plot08es.csv' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col
