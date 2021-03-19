set terminal png size 1200,600 enhanced font ',11'
set title "24. Deaths added daily and weekly to the MoMo, to see the data quality"
set grid
set tmargin 3
set rmargin 6
set bmargin 3
set lmargin 6
set auto x
set auto y
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xtics '2020-07-01',86400*30,'2021-05-01'
set xrange ['2020-06-01':'2021-06-01']
set ytic center rotate by 90
set datafile separator ','
set colors classic
set ytics 0,2000,8000
set output 'output/plot24en1.png'
plot 'middle/plot24en1.csv' u 1:2 w l ti col
set ytics 0,4000,20000
set output 'output/plot24en2.png'
plot 'middle/plot24en2.csv' u 1:2 w lp ti col
