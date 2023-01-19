set terminal png size 1200,600 enhanced font ',11'
set title "17. Deaths by week obtained from Statistisches Bundesamt (Germany)"
set grid
set tmargin 3
set rmargin 6
set bmargin 3
set lmargin 6
set auto x
set yrange [0:35000]
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xrange ['2020-01-01':'2021-01-01']
set xtics '2020-02-01',86400*30.30,'2020-12-01'
set ytic center rotate by 90
set ytics 0,5000,30000
set datafile separator ','
set colors classic
set key maxrows 4
set output 'output/plot17en.png'
plot 'middle/plot17en.csv' u 1:2 w lp ti col,\
            '' u 1:3 w lp ti col,\
            '' u 1:4 w lp ti col,\
            '' u 1:5 w lp ti col,\
            '' u 1:6 w lp ti col,\
            '' u 1:7 w lp ti col,\
            '' u 1:8 w lp ti col,\
            '' u 1:9 w lp ti col
