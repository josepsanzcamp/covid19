set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set title "3. Deaths per day obtained from the MoMo by 2020, 2019, 2018 and the 2018 average"
set rmargin 3
set grid
set auto x
set yrange [0:3000]
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xrange ['2020-01-01':'2020-09-01']
set xtics '2020-01-06',86400*7,'2020-09-01'
set datafile separator ';'
set output 'output/plot03en1.png'
plot ['2020-01-01':'2020-03-01'] 'middle/plot03en.csv' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:6 w l lc 9 ti col
set output 'output/plot03en2.png'
plot ['2020-03-01':'2020-05-01'] 'middle/plot03en.csv' u 1:2 w lp lc 1 pt 1 ti col, '' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:6 w l lc 9 ti col
set output 'output/plot03en3.png'
plot ['2020-05-01':'2020-07-01'] 'middle/plot03en.csv' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:5 w lp lc 4 pt 4 ti col, '' u 1:6 w l lc 9 ti col
set output 'output/plot03en4.png'
plot ['2020-07-01':'2020-09-01'] 'middle/plot03en.csv' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:5 w lp lc 4 pt 4 ti col, '' u 1:6 w l lc 9 ti col
