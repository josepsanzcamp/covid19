set terminal png size 1200,600 enhanced font ',11'
set title "26. Número de líneas de diferencia entre cada fichero del MoMo comparando solo las 365 primeras lineas de datos"
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
set xtics '2020-06-01',86400*30,'2021-07-01'
set xrange ['2020-05-23':'2021-07-13']
set ytic center rotate by 90
set datafile separator ','
set colors classic
set output 'output/plot26es.png'
plot 'middle/plot26es.csv' u 2:3 w l ti col
