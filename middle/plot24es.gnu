set terminal png size 1200,600 enhanced font ',11'
set title "24. Defunciones añadidas diariamente y semanalmente en el MoMo, y la media del INE del 2018"
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
set xrange ['2020-05-30':'2021-07-13']
set ytic center rotate by 90
set datafile separator ','
set colors classic
set ytics 0,2000,8000
set output 'output/plot24es1.png'
set label 1 "Atención: esta gráfica tiene la escala diferente que la otra gráfica del mismo grupo" at '2020-09-15',7000 c tc lt 1
plot 'middle/plot24es1.csv' u 1:2 w l ti col,\
            '' u 1:3 w l ti col
set ytics 0,2000,20000
set output 'output/plot24es2.png'
set label 1 "Atención: esta gráfica tiene la escala diferente que la otra gráfica del mismo grupo" at '2020-09-15',11000 c tc lt 1
plot 'middle/plot24es2.csv' u 1:2 w lp ti col,\
            '' u 1:3 w l ti col
