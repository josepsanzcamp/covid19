set terminal png size 1200,600 enhanced font ',11'
set title "20. Evolución de los datos del Índice Nacional de Defunciones"
set grid
set tmargin 3
set rmargin 6
set bmargin 3
set lmargin 6
set auto x
set yrange [350000:450000]
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xrange ['2020-02-01':'2021-02-01']
set xtics '2020-03-01',86400*60,'2021-01-01'
set ytic center rotate by 90
set ytics 360000,20000,440000
set datafile separator ';'
set colors classic
set output 'output/plot20es.png'
plot 'middle/plot20es.csv' u 1:2 w lp ti col,'' u 1:3 w lp ti col,'' u 1:4 w lp ti col
