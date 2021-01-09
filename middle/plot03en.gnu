set terminal png size 1200,600 enhanced font ',11'
set title "3. Deaths per day obtained from the MoMo by 2021, 2020, 2019, 2018 and the 2018 average"
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
set xtics '2020-01-06',86400*7,'2021-01-01'
set ytic center rotate by 90
set ytics 0,500,3000
set datafile separator ';'
set colors classic
set output 'output/plot03en1.png'
set xrange ['2020-01-01':'2020-03-01']
plot 'middle/plot03en.csv' u 1:2 w lp lc 1 pt 1 ti col, '' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:5 w lp lc 4 pt 4 ti col, '' u 1:6 w lp lc 5 pt 5 ti col, '' u 1:7 w l lc 6 ti col
set output 'output/plot03en2.png'
set xrange ['2020-03-01':'2020-05-01']
plot 'middle/plot03en.csv' u 1:2 w lp lc 1 pt 1 ti col, '' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:5 w lp lc 4 pt 4 ti col, '' u 1:6 w lp lc 5 pt 5 ti col, '' u 1:7 w l lc 6 ti col
set output 'output/plot03en3.png'
set xrange ['2020-05-01':'2020-07-01']
plot 'middle/plot03en.csv' u 1:2 w lp lc 1 pt 1 ti col, '' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:5 w lp lc 4 pt 4 ti col, '' u 1:6 w lp lc 5 pt 5 ti col, '' u 1:7 w l lc 6 ti col
set output 'output/plot03en4.png'
set xrange ['2020-07-01':'2020-09-01']
plot 'middle/plot03en.csv' u 1:2 w lp lc 1 pt 1 ti col, '' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:5 w lp lc 4 pt 4 ti col, '' u 1:6 w lp lc 5 pt 5 ti col, '' u 1:7 w l lc 6 ti col
set output 'output/plot03en5.png'
set xrange ['2020-09-01':'2020-11-01']
plot 'middle/plot03en.csv' u 1:2 w lp lc 1 pt 1 ti col, '' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:5 w lp lc 4 pt 4 ti col, '' u 1:6 w lp lc 5 pt 5 ti col, '' u 1:7 w l lc 6 ti col
set output 'output/plot03en6.png'
set xrange ['2020-11-01':'2021-01-01']
plot 'middle/plot03en.csv' u 1:2 w lp lc 1 pt 1 ti col, '' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:5 w lp lc 4 pt 4 ti col, '' u 1:6 w lp lc 5 pt 5 ti col, '' u 1:7 w l lc 6 ti col
