set terminal png size 1200,600 enhanced font ',11'
set title "3. Defuncions per dia obtinguts del MoMo i la mitjana del 2018"
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
set datafile separator ','
set colors classic
set output 'output/plot03ca1.png'
set xrange ['2020-01-01':'2020-03-01']
plot 'middle/plot03ca.csv' u 1:2 w lp ti col,\
            '' u 1:3 w lp ti col,\
            '' u 1:4 w lp ti col,\
            '' u 1:5 w lp ti col,\
            '' u 1:6 w lp ti col,\
            '' u 1:7 w lp ti col,\
            '' u 1:8 w lp ti col,\
            '' u 1:9 w lp ti col,\
            '' u 1:10 w l ti col
set output 'output/plot03ca2.png'
set xrange ['2020-03-01':'2020-05-01']
plot 'middle/plot03ca.csv' u 1:2 w lp ti col,\
            '' u 1:3 w lp ti col,\
            '' u 1:4 w lp ti col,\
            '' u 1:5 w lp ti col,\
            '' u 1:6 w lp ti col,\
            '' u 1:7 w lp ti col,\
            '' u 1:8 w lp ti col,\
            '' u 1:9 w lp ti col,\
            '' u 1:10 w l ti col
set output 'output/plot03ca3.png'
set xrange ['2020-05-01':'2020-07-01']
plot 'middle/plot03ca.csv' u 1:2 w lp ti col,\
            '' u 1:3 w lp ti col,\
            '' u 1:4 w lp ti col,\
            '' u 1:5 w lp ti col,\
            '' u 1:6 w lp ti col,\
            '' u 1:7 w lp ti col,\
            '' u 1:8 w lp ti col,\
            '' u 1:9 w lp ti col,\
            '' u 1:10 w l ti col
set output 'output/plot03ca4.png'
set xrange ['2020-07-01':'2020-09-01']
plot 'middle/plot03ca.csv' u 1:2 w lp ti col,\
            '' u 1:3 w lp ti col,\
            '' u 1:4 w lp ti col,\
            '' u 1:5 w lp ti col,\
            '' u 1:6 w lp ti col,\
            '' u 1:7 w lp ti col,\
            '' u 1:8 w lp ti col,\
            '' u 1:9 w lp ti col,\
            '' u 1:10 w l ti col
set output 'output/plot03ca5.png'
set xrange ['2020-09-01':'2020-11-01']
plot 'middle/plot03ca.csv' u 1:2 w lp ti col,\
            '' u 1:3 w lp ti col,\
            '' u 1:4 w lp ti col,\
            '' u 1:5 w lp ti col,\
            '' u 1:6 w lp ti col,\
            '' u 1:7 w lp ti col,\
            '' u 1:8 w lp ti col,\
            '' u 1:9 w lp ti col,\
            '' u 1:10 w l ti col
set output 'output/plot03ca6.png'
set xrange ['2020-11-01':'2021-01-01']
plot 'middle/plot03ca.csv' u 1:2 w lp ti col,\
            '' u 1:3 w lp ti col,\
            '' u 1:4 w lp ti col,\
            '' u 1:5 w lp ti col,\
            '' u 1:6 w lp ti col,\
            '' u 1:7 w lp ti col,\
            '' u 1:8 w lp ti col,\
            '' u 1:9 w lp ti col,\
            '' u 1:10 w l ti col
