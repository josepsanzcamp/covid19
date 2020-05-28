set terminal pngcairo size 1200,1800 enhanced font 'Segoe UI,10'
set output 'output/plot3en.png'
set multiplot layout 3,1 title "Deaths per day obtained from the MoMo by 2020, per day from the Renave, the 2018 average and the difference between MoMo and Renave"
set rmargin 3
set grid
set auto x
set yrange [0:3000]
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xrange ['2020-01-01':'2020-07-01']
set xtic rotate by -45 scale 0
set datafile separator ';'
set xtics '2020-01-01',86400*7,'2020-07-01'
plot ['2020-01-01':'2020-03-01'] 'middle/plot3en.csv' using 1:2 w l ti col, '' using 1:6 w l ti col
plot ['2020-03-01':'2020-05-01'] 'middle/plot3en.csv' using 1:2 w l ti col, '' using 1:3 w l ti col, '' using 1:4 w l ti col, '' using 1:5 w l ti col, '' using 1:6 w l ti col
plot ['2020-05-01':'2020-07-01'] 'middle/plot3en.csv' using 1:2 w l ti col, '' using 1:3 w l ti col, '' using 1:4 w l ti col, '' using 1:5 w l ti col, '' using 1:6 w l ti col
unset multiplot
