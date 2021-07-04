set terminal png size 1200,600 enhanced font ',11'
set title "7. Relación de camas de hospital, enfermeras y médicos por país en 2019 o ultimo año donde existan datos segun datos OECD"
set grid
set tmargin 3
set rmargin 6
set bmargin 6
set lmargin 6
set auto x
set auto y
set style data histogram
set style fill solid border -1
set xtic rotate by -45
set style histogram gap 3
set yrange [0:20]
set ytic center rotate by 90
set ytics 0,5,15
set datafile separator ','
set colors classic
set output 'output/plot07es1.png'
set xrange [-0.5:21.5]
plot 'middle/plot07es.csv' u 2:xtic(1) ti col,\
            '' u 4:xtic(1) ti col,\
            '' u 6:xtic(1) ti col
set output 'output/plot07es2.png'
set xrange [21.5:43.5]
plot 'middle/plot07es.csv' u 2:xtic(1) ti col,\
            '' u 4:xtic(1) ti col,\
            '' u 6:xtic(1) ti col
