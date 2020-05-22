set terminal pngcairo size 1200,1800 enhanced font 'Segoe UI,10'
set output 'output/plot3ca.png'
set multiplot layout 3,1 title "Defuncions per dia obtinguts del MoMo per al 2020"
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
plot ['2020-01-01':'2020-03-01'] 'middle/plot3ca.csv' using 1:2 w l ti ''
plot ['2020-03-01':'2020-05-01'] 'middle/plot3ca.csv' using 1:2 w l ti ''
plot ['2020-05-01':'2020-07-01'] 'middle/plot3ca.csv' using 1:2 w l ti ''
unset multiplot
