set terminal pngcairo size 1200,14400 enhanced font 'Segoe UI,10'
set output 'output/plot9ca.png'
set multiplot layout 24,1 title "Defuncions per setmana del any y per pais obtingudes del EuroMoMo (el valor que es mostra es el zscore)"
set rmargin 3
set grid
set auto x
set yrange [-10:50]
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xrange ['2015-01-01':'2020-07-01']
set xtic rotate by -45 scale 0
set datafile separator ';'
set xtics '2015-01-01',86400*7.1*13,'2020-07-01'
plot 'middle/plot9ca.csv' u 1:2 w lp lc 1 pt 1 ti col
plot 'middle/plot9ca.csv' u 1:3 w lp lc 3 pt 2 ti col
plot 'middle/plot9ca.csv' u 1:4 w lp lc 4 pt 3 ti col
plot 'middle/plot9ca.csv' u 1:5 w lp lc 7 pt 4 ti col
plot 'middle/plot9ca.csv' u 1:6 w lp lc 8 pt 5 ti col
plot 'middle/plot9ca.csv' u 1:7 w lp lc 9 pt 6 ti col
plot 'middle/plot9ca.csv' u 1:8 w lp lc 1 pt 7 ti col
plot 'middle/plot9ca.csv' u 1:9 w lp lc 3 pt 8 ti col
plot 'middle/plot9ca.csv' u 1:10 w lp lc 4 pt 9 ti col
plot 'middle/plot9ca.csv' u 1:11 w lp lc 7 pt 10 ti col
plot 'middle/plot9ca.csv' u 1:12 w lp lc 8 pt 11 ti col
plot 'middle/plot9ca.csv' u 1:13 w lp lc 9 pt 12 ti col
plot 'middle/plot9ca.csv' u 1:14 w lp lc 1 pt 13 ti col
plot 'middle/plot9ca.csv' u 1:15 w lp lc 3 pt 14 ti col
plot 'middle/plot9ca.csv' u 1:16 w lp lc 4 pt 15 ti col
plot 'middle/plot9ca.csv' u 1:17 w lp lc 7 pt 16 ti col
plot 'middle/plot9ca.csv' u 1:18 w lp lc 8 pt 17 ti col
plot 'middle/plot9ca.csv' u 1:19 w lp lc 9 pt 18 ti col
plot 'middle/plot9ca.csv' u 1:20 w lp lc 1 pt 19 ti col
plot 'middle/plot9ca.csv' u 1:21 w lp lc 3 pt 20 ti col
plot 'middle/plot9ca.csv' u 1:22 w lp lc 4 pt 21 ti col
plot 'middle/plot9ca.csv' u 1:23 w lp lc 7 pt 22 ti col
plot 'middle/plot9ca.csv' u 1:24 w lp lc 8 pt 23 ti col
plot 'middle/plot9ca.csv' u 1:25 w lp lc 9 pt 24 ti col
unset multiplot
