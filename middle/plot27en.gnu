set terminal png size 1200,600 enhanced font ',11'
set title "27. Deaths per day obtained from MoMo (with points at 27/05/2020, 26/04/2022, 20/12/2022 and current), and the 2018 average"
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
set ytic center rotate by 90
set ytics 0,500,3000
set datafile separator ','
set colors classic
set output 'output/plot27en1.png'
set xtics '2015-02-01',86400*30.41,'2015-12-01'
set xrange ['2015-01-01':'2016-01-01']
plot 'middle/plot27en.csv' u 1:2 w l ti col,\
            '' u 1:3 w l ti col,\
            '' u 1:4 w l ti col,\
            '' u 1:5 w l ti col,\
            '' u 1:6 w l ti col
set output 'output/plot27en2.png'
set xtics '2016-02-01',86400*30.41,'2016-12-01'
set xrange ['2016-01-01':'2017-01-01']
plot 'middle/plot27en.csv' u 1:2 w l ti col,\
            '' u 1:3 w l ti col,\
            '' u 1:4 w l ti col,\
            '' u 1:5 w l ti col,\
            '' u 1:6 w l ti col
set output 'output/plot27en3.png'
set xtics '2017-02-01',86400*30.41,'2017-12-01'
set xrange ['2017-01-01':'2018-01-01']
plot 'middle/plot27en.csv' u 1:2 w l ti col,\
            '' u 1:3 w l ti col,\
            '' u 1:4 w l ti col,\
            '' u 1:5 w l ti col,\
            '' u 1:6 w l ti col
set output 'output/plot27en4.png'
set xtics '2018-02-01',86400*30.41,'2018-12-01'
set xrange ['2018-01-01':'2019-01-01']
plot 'middle/plot27en.csv' u 1:2 w l ti col,\
            '' u 1:3 w l ti col,\
            '' u 1:4 w l ti col,\
            '' u 1:5 w l ti col,\
            '' u 1:6 w l ti col
set output 'output/plot27en5.png'
set xtics '2019-02-01',86400*30.41,'2019-12-01'
set xrange ['2019-01-01':'2020-01-01']
plot 'middle/plot27en.csv' u 1:2 w l ti col,\
            '' u 1:3 w l ti col,\
            '' u 1:4 w l ti col,\
            '' u 1:5 w l ti col,\
            '' u 1:6 w l ti col
set output 'output/plot27en6.png'
set xtics '2020-02-01',86400*30.41,'2020-12-01'
set xrange ['2020-01-01':'2021-01-01']
plot 'middle/plot27en.csv' u 1:2 w l ti col,\
            '' u 1:3 w l ti col,\
            '' u 1:4 w l ti col,\
            '' u 1:5 w l ti col,\
            '' u 1:6 w l ti col
set output 'output/plot27en7.png'
set xtics '2021-02-01',86400*30.41,'2021-12-01'
set xrange ['2021-01-01':'2022-01-01']
plot 'middle/plot27en.csv' u 1:2 w l ti col,\
            '' u 1:3 w l ti col,\
            '' u 1:4 w l ti col,\
            '' u 1:5 w l ti col,\
            '' u 1:6 w l ti col
set output 'output/plot27en8.png'
set xtics '2022-02-01',86400*30.41,'2022-12-01'
set xrange ['2022-01-01':'2023-01-01']
plot 'middle/plot27en.csv' u 1:2 w l ti col,\
            '' u 1:3 w l ti col,\
            '' u 1:4 w l ti col,\
            '' u 1:5 w l ti col,\
            '' u 1:6 w l ti col
