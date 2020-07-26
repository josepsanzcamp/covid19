set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set title "13. Defunciones por semana obtenidos del Statistics Portugal"
set rmargin 3
set grid
set auto x
set yrange [0:3500]
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xrange ['2020-01-01':'2021-01-01']
set xtics '2020-02-01',86400*30,'2020-12-01'
set datafile separator ';'
set output 'output/plot13es.png'
plot 'middle/plot13es.csv' u 1:2 w lp ti col,'' u 1:3 w lp ti col,'' u 1:4 w lp ti col
