set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set title "3. Defunciones por dia obtenidos del MoMo para el 2020, 2019, 2018 y el promedio del 2018"
set rmargin 3
set grid
set auto x
set yrange [0:3000]
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xrange ['2020-01-01':'2020-07-01']
set xtic rotate by -45 scale 0
set datafile separator ';'
set xtics '2020-01-01',86400*7,'2020-07-01'
set output 'output/plot3es1.png'
plot ['2020-01-01':'2020-03-01'] 'middle/plot3es.csv' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:6 w l lc 9 ti col
set output 'output/plot3es2.png'
plot ['2020-03-01':'2020-05-01'] 'middle/plot3es.csv' u 1:2 w lp lc 1 pt 1 ti col, '' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:6 w l lc 9 ti col
set output 'output/plot3es3.png'
plot ['2020-05-01':'2020-07-01'] 'middle/plot3es.csv' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:5 w lp lc 4 pt 4 ti col, '' u 1:6 w l lc 9 ti col
set output 'output/plot3es4.png'
plot ['2020-07-01':'2020-09-01'] 'middle/plot3es.csv' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:5 w lp lc 4 pt 4 ti col, '' u 1:6 w l lc 9 ti col
