set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set title "4. Deaths by year, month and age (2020 data are from MoMo and the rest are from INE)"
set rmargin 3
set grid
set auto x
set yrange [0:60000]
set style data histogram
set style fill solid border -1
set style histogram gap 3
set datafile separator ';'
set output 'output/plot4en1.png'
plot [-0.5:11.5] 'middle/plot4en.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col
set yrange [0:20000]
set label 1 "Atencion: this plot has a different scale related to the previous plot of the same group" at 5.5,17500 c tc lt 1
set output 'output/plot4en2.png'
plot [-0.5:11.5] 'middle/plot4en.csv' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col
set output 'output/plot4en3.png'
plot [-0.5:11.5] 'middle/plot4en.csv' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col
