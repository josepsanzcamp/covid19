set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set output 'output/plot11ca.png'
set multiplot layout 1,1 title "11. Defuncions per dia obtinguts del Statistics Norway"
set rmargin 3
set grid
set auto x
set yrange [0:1500]
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xrange ['2020-01-01':'2021-01-01']
set xtic rotate by -45 scale 0
set datafile separator ';'
set xtics '2020-01-01',86400*30,'2021-01-01'
plot 'middle/plot11ca.csv' u 1:2 w lp ti col,'' u 1:3 w lp ti col,'' u 1:4 w lp ti col,'' u 1:5 w lp ti col,'' u 1:6 w lp ti col,'' u 1:7 w lp lc 7 ti col
unset multiplot
