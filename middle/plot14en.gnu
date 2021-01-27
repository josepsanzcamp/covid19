set terminal png size 1200,600 enhanced font ',11'
set title "14. Deaths by year obtained from MoMo and INE (combining data from the same year and the previous year)"
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
set yrange [0:600000]
set ytic center rotate by 90
set ytics 0,100000,500000
set datafile separator ','
set colors classic
set key at 2020,300000
set output 'output/plot14en.png'
plot 'middle/plot14en.csv' u 1:2 w lp ti col, '' u 1:3 w lp ti col, '' u 1:4 w lp ti col, '' u 1:5 w lp ti col, '' u 1:6 w lp ti col, '' u 1:7 w lp ti col, '' u 1:8 w lp ti col, '' u 1:9 w lp ti col, '' u 1:10 w lp ti col
