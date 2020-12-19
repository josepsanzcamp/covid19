set terminal gif size 1200,600 enhanced font ',10'
set title "15. Evolución de las defunciones segunda ola por dia obtenidos del MoMo para el 2020, 2019, 2018 y el promedio del 2018 (2020-12-19)"
set grid
set tmargin 3
set rmargin 6
set bmargin 3
set lmargin 6
set auto x
set yrange [0:3500]
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xtics '2020-01-06',86400*14,'2021-01-01'
set ytic center rotate by 90
set ytics 0,500,3000
set datafile separator ';'
set output 'output/plot15es.20201219.gif'
set xrange ['2020-10-01':'2021-01-01']
plot 'middle/plot15es.20201219.csv' u 1:2 w lp ti col, '' u 1:3 w lp ti col, '' u 1:4 w lp ti col, '' u 1:5 w l ti col
