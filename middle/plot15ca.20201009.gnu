set terminal gif size 1200,600 enhanced font ',10'
set title "15. Evolucio de defuncions per dia obtinguts del MoMo per al 2020, 2019, 2018 i el promig del 2018 (2020-10-09)"
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
set xtics '2020-01-06',86400*7,'2021-01-01'
set ytic center rotate by 90
set ytics 0,500,3000
set datafile separator ';'
set output 'output/plot15ca.20201009.gif'
set xrange ['2020-10-01':'2020-12-01']
plot 'middle/plot15ca.20201009.csv' u 1:2 w lp lc 2 pt 2 ti col, '' u 1:3 w lp lc 3 pt 3 ti col, '' u 1:4 w lp lc 4 pt 4 ti col, '' u 1:5 w l lc 9 ti col
