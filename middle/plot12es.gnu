set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set title "12. Defunciones por dia obtenidos del MoMo"
set rmargin 3
set grid
set auto x
set yrange [0:3000]
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xrange ['2020-01-01':'2021-01-01']
set xtic rotate by -45 scale 0
set datafile separator ';'
set xtics '2020-01-01',86400*30,'2021-01-01'
set output 'output/plot12es.png'
plot 'middle/plot12es.csv' u 1:4 w l ti col,'' u 1:3 w l ti col,'' u 1:2 w l ti col
