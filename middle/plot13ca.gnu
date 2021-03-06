set terminal png size 1200,600 enhanced font ',11'
set title "13. Defuncions per dia obtinguts del SICO Portugal"
set grid
set tmargin 3
set rmargin 6
set bmargin 3
set lmargin 6
set auto x
set yrange [0:900]
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xrange ['2020-01-01':'2021-01-01']
set xtics '2020-02-01',86400*30,'2020-12-01'
set ytic center rotate by 90
set ytics 0,150,750
set datafile separator ','
set colors classic
set output 'output/plot13ca.png'
plot 'middle/plot13ca.csv' u 1:8 w l ti col,\
            '' u 1:9 w l ti col,\
            '' u 1:10 w l ti col,\
            '' u 1:11 w l ti col,\
            '' u 1:12 w l ti col,\
            '' u 1:13 w l ti col,\
            '' u 1:14 w l ti col
