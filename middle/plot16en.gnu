set terminal png size 1200,600 enhanced font ',11'
set title "16. Deaths per day obtained from the Institut National de la statistique et des études économiques (France)"
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
set xrange ['2020-01-01':'2021-01-01']
set xtics '2020-02-01',86400*30.41,'2020-12-01'
set ytic center rotate by 90
set ytics 0,500,3000
set datafile separator ','
set colors classic
set output 'output/plot16en.png'
plot 'middle/plot16en.csv' u 1:2 w l ti col,\
            '' u 1:3 w l ti col,\
            '' u 1:4 w l ti col,\
            '' u 1:5 w l ti col,\
            '' u 1:6 w l ti col,\
            '' u 1:7 w l ti col
