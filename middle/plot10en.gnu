set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set title "10. Deaths by day obtained from Statistics Sweden"
set grid
set tmargin 3
set rmargin 6
set bmargin 3
set lmargin 6
set auto x
set yrange [0:500]
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xrange ['2020-01-01':'2021-01-01']
set xtics '2020-02-01',86400*30,'2020-12-01'
set ytic center rotate by 90
set ytics 0,100,400
set datafile separator ';'
set output 'output/plot10en.png'
plot 'middle/plot10en.csv' u 1:2 w l ti col,'' u 1:3 w l ti col,'' u 1:4 w l ti col,'' u 1:5 w l ti col,'' u 1:6 w l ti col,'' u 1:7 w l lc 7 ti col
