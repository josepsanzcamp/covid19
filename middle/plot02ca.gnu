set terminal png size 1200,600 enhanced font ',11'
set title "2. Defuncions per any i mes del MoMo i INE"
set grid
set tmargin 3
set rmargin 6
set bmargin 3
set lmargin 6
set auto x
set yrange [0:70000]
set style data histogram
set style fill solid border -1
set style histogram gap 3
set ytic center rotate by 90
set ytics 0,10000,60000
set datafile separator ','
set colors classic
set output 'output/plot02ca1.png'
set xrange [-0.5:11.5]
plot 'middle/plot02ca.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col
set output 'output/plot02ca2.png'
set xrange [11.5:23.5]
plot 'middle/plot02ca.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col
set output 'output/plot02ca3.png'
set xrange [23.5:35.5]
plot 'middle/plot02ca.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col
set output 'output/plot02ca4.png'
set xrange [35.5:47.5]
plot 'middle/plot02ca.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col
set output 'output/plot02ca5.png'
set xrange [47.5:59.5]
plot 'middle/plot02ca.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col
set output 'output/plot02ca6.png'
set xrange [59.5:71.5]
plot 'middle/plot02ca.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col
set output 'output/plot02ca7.png'
set xrange [71.5:83.5]
plot 'middle/plot02ca.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col
set output 'output/plot02ca8.png'
set xrange [83.5:95.5]
plot 'middle/plot02ca.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col
