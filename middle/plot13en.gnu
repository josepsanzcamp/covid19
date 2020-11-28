set terminal png size 1200,600 enhanced font ',10'
set title "13. Deaths by day obtained from SICO Portugal"
set grid
set tmargin 3
set rmargin 6
set bmargin 3
set lmargin 6
set auto x
set yrange [0:700]
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xrange ['2020-01-01':'2021-01-01']
set xtics '2020-02-01',86400*30,'2020-12-01'
set ytic center rotate by 90
set ytics 0,100,600
set datafile separator ';'
set output 'output/plot13en.png'
plot 'middle/plot13en.csv' u 1:8 w l ti col,'' u 1:9 w l ti col,'' u 1:10 w l ti col,'' u 1:11 w l ti col,'' u 1:12 w l ti col,'' u 1:13 w l ti col
