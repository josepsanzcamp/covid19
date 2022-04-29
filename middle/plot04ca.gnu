set terminal png size 1200,600 enhanced font ',11'
set title "4. Defuncions per any, mes i edat (les dades >= 2020 són del MoMo i la resta són del INE)"
set grid
set tmargin 3
set rmargin 6
set bmargin 3
set lmargin 6
set auto x
set yrange [0:70000]
set style data histogram
set style fill solid border -1
set style histogram gap 3
set ytic center rotate by 90
set ytics 0,10000,60000
set datafile separator ','
set colors classic
set output 'output/plot04ca1.png'
set xrange [-0.5:11.5]
plot 'middle/plot04ca.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col,\
            '' u 4:xtic(1) ti col,\
            '' u 5:xtic(1) ti col,\
            '' u 6:xtic(1) ti col
set yrange [0:12000]
set ytics 0,2000,10000
set label 1 "Atenció: aquesta gràfica te l'escala diferent que la gràfica anterior del mateix grup" at 5.5,9000 c tc lt 1
set output 'output/plot04ca2.png'
set xrange [-0.5:11.5]
plot 'middle/plot04ca.csv' u 7:xtic(1) ti col,\
            '' u 8:xtic(1) ti col,\
            '' u 9:xtic(1) ti col,\
            '' u 10:xtic(1) ti col,\
            '' u 11:xtic(1) ti col
set output 'output/plot04ca3.png'
set xrange [-0.5:11.5]
plot 'middle/plot04ca.csv' u 12:xtic(1) ti col,\
            '' u 13:xtic(1) ti col,\
            '' u 14:xtic(1) ti col,\
            '' u 15:xtic(1) ti col,\
            '' u 16:xtic(1) ti col
