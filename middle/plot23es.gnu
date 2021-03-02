set terminal png size 1200,600 enhanced font ',11'
set title "23. Defunciones por año del Índice Nacional de defunciones y del Instituto Nacional de Estadística (6545 y 35177)"
set grid
set tmargin 3
set rmargin 6
set bmargin 3
set lmargin 6
set auto x
set auto y
set style data histogram
set style fill solid border -1
set xtic rotate by -45
set style histogram gap 3
set yrange [0:600000]
set ytic center rotate by 90
set ytics 0,100000,500000
set datafile separator ','
set colors classic
set output 'output/plot23es.png'
plot 'middle/plot23es.csv' u 1:2 w lp ti col, '' u 1:3 w lp ti col, '' u 1:4 w lp ti col
