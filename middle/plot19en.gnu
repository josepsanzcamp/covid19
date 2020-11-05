set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set title "19. Deaths by week obtained from Statistics Spain"
set grid
set tmargin 3
set rmargin 6
set bmargin 3
set lmargin 6
set auto x
set yrange [0:30000]
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xrange ['2020-01-01':'2021-01-01']
set xtics '2020-02-01',86400*30,'2020-12-01'
set ytic center rotate by 90
set ytics 0,6000,24000
set datafile separator ';'
set output 'output/plot19en.png'
plot 'middle/plot19en.csv' u 1:2 w lp ti col,'' u 1:3 w lp ti col,'' u 1:4 w lp ti col,'' u 1:5 w lp ti col,'' u 1:6 w lp ti col,'' u 1:7 w lp lc 7 ti col
