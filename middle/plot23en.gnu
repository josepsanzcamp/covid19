set terminal png size 1200,600 enhanced font ',11'
set title "23. Deaths by year from the National Death Index and the National Institute of Statistics (6545 and 35177)"
set grid
set tmargin 3
set rmargin 6
set bmargin 3
set lmargin 6
set auto x
set auto y
set style data histogram
set style fill solid border -1
set xtic rotate by -45
set style histogram gap 3
set xrange [1990:2022]
set yrange [0:600000]
set ytic center rotate by 90
set ytics 0,100000,500000
set datafile separator ','
set colors classic
set output 'output/plot23en.png'
plot 'middle/plot23en.csv' u 1:2 w lp ti col,\
            '' u 1:3 w lp ti col,\
            '' u 1:4 w lp ti col
