set terminal png size 1200,600 enhanced font ',11'
set title "12. Defunciones por dia obtenidos del MoMo Spain"
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
set xrange ['2020-01-01':'2021-01-01']
set xtics '2020-02-01',86400*30,'2020-12-01'
set ytic center rotate by 90
set ytics 0,500,3000
set datafile separator ';'
set colors classic
set output 'output/plot12es.png'
plot 'middle/plot12es.csv' u 1:4 w l ti col,'' u 1:3 w l ti col,'' u 1:2 w l ti col
