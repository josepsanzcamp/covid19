set terminal png size 1200,600 enhanced font ',11'
set title "21. Population structure indicators (from 1975 to 2020, data from INE)"
set grid
set tmargin 3
set rmargin 6
set bmargin 3
set lmargin 6
set auto x
set auto y
set style data histogram
set style fill solid border -1
set xtic rotate by -45
set style histogram gap 3
set yrange [0:150]
set ytic center rotate by 90
set ytics 0,25,125
set datafile separator ','
set colors classic
set output 'output/plot21en.png'
plot 'middle/plot21en.csv' u 1:2 w lp ti col,\
            '' u 1:3 w lp ti col,\
            '' u 1:4 w lp ti col,\
            '' u 1:5 w lp ti col
