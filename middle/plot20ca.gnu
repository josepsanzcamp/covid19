set terminal png size 1200,600 enhanced font ',11'
set title "20. Evolució de les dades de l'Índex Nacional de Defuncions segons cada PDF publicat"
set grid
set tmargin 3
set rmargin 6
set bmargin 5
set lmargin 6
set auto x
set yrange [0:500000]
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xtics rotate by -60
set xtics font ',10'
set ytic center rotate by 90
set ytics 0,100000,400000
set datafile separator ','
set colors classic
set key at '2025-01-01',130000
set xrange ['2022-01-01':'2025-01-01']
set output 'output/plot20ca1.png'
plot 'middle/plot20ca.csv' u 1:11:xtic(1) w lp ti col,\
            '' u 1:12 w lp ti col,\
            '' u 1:13 w lp ti col,\
            '' u 1:14 w lp ti col
set key at '2022-01-01',130000
set xrange ['2019-01-01':'2022-01-01']
set output 'output/plot20ca2.png'
plot 'middle/plot20ca.csv' u 1:8:xtic(1) w lp ti col,\
            '' u 1:9 w lp ti col,\
            '' u 1:10 w lp ti col,\
            '' u 1:11 w lp ti col,\
            '' u 1:12 w lp ti col,\
            '' u 1:13 w lp ti col
set key at '2019-01-01',130000
set xrange ['2016-01-01':'2019-01-01']
set output 'output/plot20ca3.png'
plot 'middle/plot20ca.csv' u 1:5:xtic(1) w lp ti col,\
            '' u 1:6 w lp ti col,\
            '' u 1:7 w lp ti col,\
            '' u 1:8 w lp ti col,\
            '' u 1:9 w lp ti col,\
            '' u 1:10 w lp ti col
set key at '2016-01-01',130000
set xrange ['2013-01-01':'2016-01-01']
set output 'output/plot20ca4.png'
plot 'middle/plot20ca.csv' u 1:2:xtic(1) w lp ti col,\
            '' u 1:3 w lp ti col,\
            '' u 1:4 w lp ti col,\
            '' u 1:5 w lp ti col,\
            '' u 1:6 w lp ti col,\
            '' u 1:7 w lp ti col
