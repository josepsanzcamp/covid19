set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set title "4. Defunciones por año, mes y edad (los datos del 2020 son del MoMo y el resto son del INE)"
set rmargin 3
set grid
set auto x
set yrange [0:60000]
set style data histogram
set style fill solid border -1
set xtic rotate by -45 scale 0
set datafile separator ';'
set style histogram gap 3
set output 'output/plot4es1.png'
plot [-0.5:11.5] 'middle/plot4es.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col
set yrange [0:20000]
set label 1 "Atención: esta gráfica tiene la escala diferente que la gráfica anterior del mismo grupo" at 5.5,17500 c tc lt 1
set output 'output/plot4es2.png'
plot [-0.5:11.5] 'middle/plot4es.csv' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col
set output 'output/plot4es3.png'
plot [-0.5:11.5] 'middle/plot4es.csv' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col
