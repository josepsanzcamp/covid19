set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set title "3. Defuncions per dia obtinguts del MoMo per al 2020 i el promig del 2018"
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
set output 'output/plot3ca1.png'
plot ['2020-01-01':'2020-03-01'] 'middle/plot3ca.csv' u 1:2 w lp ti col, '' u 1:3 w lp ti col, '' u 1:4 w l lc 9 ti col
set output 'output/plot3ca2.png'
plot ['2020-03-01':'2020-05-01'] 'middle/plot3ca.csv' u 1:2 w lp ti col, '' u 1:3 w lp ti col, '' u 1:4 w l lc 9 ti col
set output 'output/plot3ca3.png'
plot ['2020-05-01':'2020-07-01'] 'middle/plot3ca.csv' u 1:2 w lp ti col, '' u 1:3 w lp ti col, '' u 1:4 w l lc 9 ti col
