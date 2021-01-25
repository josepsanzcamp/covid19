set terminal png size 1200,600 enhanced font ',11'
set title "20. Evolució de les dades de l'Índex Nacional de Defuncions"
set grid
set tmargin 3
set rmargin 6
set bmargin 5
set lmargin 6
set auto x
set yrange [0:500000]
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xrange ['2019-02-01':'2021-02-01']
set xtics rotate by -45
set ytic center rotate by 90
set ytics 0,100000,400000
set datafile separator ';'
set colors classic
set key at '2021-02-01',185000
set output 'output/plot20ca.png'
plot 'middle/plot20ca.csv' u 1:2:xtic(1) w lp ti col,'' u 1:3 w lp ti col,'' u 1:4 w lp ti col,'' u 1:5 w lp ti col
