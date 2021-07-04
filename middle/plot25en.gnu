set terminal png size 1200,600 enhanced font ',11'
set title "25. Population by age obtained from the INE of year 2019 (the unit is the million people)"
set grid
set tmargin 3
set rmargin 6
set bmargin 7
set lmargin 6
set auto x
set auto y
set style data histogram
set style fill solid border -1
set xtic rotate by -45
set style histogram gap 3
set yrange [0:9]
set ytic center rotate by 90
set ytics 0,1.5,7.5
set datafile separator ','
set colors classic
set output 'output/plot25en.png'
plot 'middle/plot25en.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col,\
            '' u 4:xtic(1) ti col,\
            '' u 5:xtic(1) ti col
