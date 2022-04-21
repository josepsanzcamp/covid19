set terminal png size 1200,600 enhanced font ',11'
set title "26. Number of difference lines between each MoMo file comparing only the first 365 lines of data"
set grid
set tmargin 3
set rmargin 6
set bmargin 5
set lmargin 6
set auto x
set auto y
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xtics rotate by -45
set xtics '2020-06-01',86400*30.25,'2022-04-01'
set xrange ['2020-05-23':'2022-04-21']
set ytic center rotate by 90
set datafile separator ','
set colors classic
set output 'output/plot26en.png'
plot 'middle/plot26en.csv' u 2:3 w l ti col
