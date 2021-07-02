set terminal gif size 1200,600 enhanced font ',11'
set title "15. Evolution of the second wave deaths per day obtained from the MoMo by 2018, 2019, 2020 and the 2018 average (2020-10-31)"
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
set datafile separator ','
set colors classic
set output 'output/plot15en.20201031.gif'
set xrange ['2020-10-01':'2021-01-01']
plot 'middle/plot15en.20201031.csv' u 1:2 w lp ti col, '' u 1:3 w lp ti col, '' u 1:4 w lp ti col, '' u 1:5 w l ti col
