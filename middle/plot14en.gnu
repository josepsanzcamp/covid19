set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
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
set yrange [0:500]
set ytic center rotate by 90
set ytics 0,100,400
set datafile separator ';'
set key right center
set output 'output/plot14en.png'
plot 'middle/plot14en.csv' u 1:2 w l ti col, '' u 1:3 w l ti col, '' u 1:4 w l ti col, '' u 1:5 w l ti col, '' u 1:6 w l ti col, '' u 1:7 w l ti col, '' u 1:8 w l ti col, '' u 1:9 w l ti col
