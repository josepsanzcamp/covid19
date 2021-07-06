set terminal png size 1200,600 enhanced font ',11'
set title "18. Deaths by week of year and by country obtained from the Eurostat"
set grid
set tmargin 3
set rmargin 6
set bmargin 3
set lmargin 6
set auto x
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xrange ['2020-01-01':'2021-01-01']
set xtics '2020-02-01',86400*30,'2020-12-01'
set ytic center rotate by 90
set datafile separator ','
set colors classic
set yrange [0:2000]
set ytics 0,400,1600
set output 'output/plot18en01.png'
plot 'middle/plot18en.csv' u 1:2 w lp ti col,'' u 1:3 w lp ti col,'' u 1:4 w lp ti col,'' u 1:5 w lp ti col,'' u 1:6 w lp ti col,'' u 1:7 w lp ti col,'' u 1:8 w lp ti col
set yrange [0:20]
set ytics 0,4,16
set output 'output/plot18en02.png'
plot 'middle/plot18en.csv' u 1:9 w lp ti col,'' u 1:10 w lp ti col,'' u 1:11 w lp ti col,'' u 1:12 w lp ti col,'' u 1:13 w lp ti col,'' u 1:14 w lp ti col,'' u 1:15 w lp ti col
set yrange [0:2000]
set ytics 0,400,1600
set output 'output/plot18en03.png'
plot 'middle/plot18en.csv' u 1:16 w lp ti col,'' u 1:17 w lp ti col,'' u 1:18 w lp ti col,'' u 1:19 w lp ti col,'' u 1:20 w lp ti col,'' u 1:21 w lp ti col,'' u 1:22 w lp ti col
set yrange [0:3000]
set ytics 0,600,2400
set output 'output/plot18en04.png'
plot 'middle/plot18en.csv' u 1:23 w lp ti col,'' u 1:24 w lp ti col,'' u 1:25 w lp ti col,'' u 1:26 w lp ti col,'' u 1:27 w lp ti col,'' u 1:28 w lp ti col,'' u 1:29 w lp ti col
set yrange [0:5000]
set ytics 0,1000,4000
set output 'output/plot18en05.png'
plot 'middle/plot18en.csv' u 1:30 w lp ti col,'' u 1:31 w lp ti col,'' u 1:32 w lp ti col,'' u 1:33 w lp ti col,'' u 1:34 w lp ti col,'' u 1:35 w lp ti col,'' u 1:36 w lp ti col
set yrange [0:6000]
set ytics 0,1200,4800
set output 'output/plot18en06.png'
plot 'middle/plot18en.csv' u 1:37 w lp ti col,'' u 1:38 w lp ti col,'' u 1:39 w lp ti col,'' u 1:40 w lp ti col,'' u 1:41 w lp ti col,'' u 1:42 w lp ti col,'' u 1:43 w lp ti col
set yrange [0:2000]
set ytics 0,400,1600
set output 'output/plot18en07.png'
plot 'middle/plot18en.csv' u 1:44 w lp ti col,'' u 1:45 w lp ti col,'' u 1:46 w lp ti col,'' u 1:47 w lp ti col,'' u 1:48 w lp ti col,'' u 1:49 w lp ti col,'' u 1:50 w lp ti col
set yrange [0:300]
set ytics 0,60,240
set output 'output/plot18en08.png'
plot 'middle/plot18en.csv' u 1:51 w lp ti col,'' u 1:52 w lp ti col,'' u 1:53 w lp ti col,'' u 1:54 w lp ti col,'' u 1:55 w lp ti col,'' u 1:56 w lp ti col,'' u 1:57 w lp ti col
set yrange [0:5000]
set ytics 0,1000,4000
set output 'output/plot18en09.png'
plot 'middle/plot18en.csv' u 1:58 w lp ti col,'' u 1:59 w lp ti col,'' u 1:60 w lp ti col,'' u 1:61 w lp ti col,'' u 1:62 w lp ti col,'' u 1:63 w lp ti col,'' u 1:64 w lp ti col
set yrange [0:2000]
set ytics 0,400,1600
set output 'output/plot18en10.png'
plot 'middle/plot18en.csv' u 1:65 w lp ti col,'' u 1:66 w lp ti col,'' u 1:67 w lp ti col,'' u 1:68 w lp ti col,'' u 1:69 w lp ti col,'' u 1:70 w lp ti col,'' u 1:71 w lp ti col
set yrange [0:5000]
set ytics 0,1000,4000
set output 'output/plot18en11.png'
plot 'middle/plot18en.csv' u 1:72 w lp ti col,'' u 1:73 w lp ti col,'' u 1:74 w lp ti col,'' u 1:75 w lp ti col,'' u 1:76 w lp ti col,'' u 1:77 w lp ti col,'' u 1:78 w lp ti col
set yrange [0:600]
set ytics 0,120,480
set output 'output/plot18en12.png'
plot 'middle/plot18en.csv' u 1:79 w lp ti col,'' u 1:80 w lp ti col,'' u 1:81 w lp ti col,'' u 1:82 w lp ti col,'' u 1:83 w lp ti col,'' u 1:84 w lp ti col,'' u 1:85 w lp ti col
set yrange [0:2000]
set ytics 0,400,1600
set output 'output/plot18en13.png'
plot 'middle/plot18en.csv' u 1:86 w lp ti col,'' u 1:87 w lp ti col,'' u 1:88 w lp ti col,'' u 1:89 w lp ti col,'' u 1:90 w lp ti col,'' u 1:91 w lp ti col,'' u 1:92 w lp ti col
set yrange [0:30000]
set ytics 0,6000,24000
set output 'output/plot18en14.png'
plot 'middle/plot18en.csv' u 1:93 w lp ti col,'' u 1:94 w lp ti col,'' u 1:95 w lp ti col,'' u 1:96 w lp ti col,'' u 1:97 w lp ti col,'' u 1:98 w lp ti col,'' u 1:99 w lp ti col
set yrange [0:2000]
set ytics 0,400,1600
set output 'output/plot18en15.png'
plot 'middle/plot18en.csv' u 1:100 w lp ti col,'' u 1:101 w lp ti col,'' u 1:102 w lp ti col,'' u 1:103 w lp ti col,'' u 1:104 w lp ti col,'' u 1:105 w lp ti col,'' u 1:106 w lp ti col
set yrange [0:30000]
set ytics 0,6000,24000
set output 'output/plot18en16.png'
plot 'middle/plot18en.csv' u 1:107 w lp ti col,'' u 1:108 w lp ti col,'' u 1:109 w lp ti col,'' u 1:110 w lp ti col,'' u 1:111 w lp ti col,'' u 1:112 w lp ti col,'' u 1:113 w lp ti col
set yrange [0:6000]
set ytics 0,1200,4800
set output 'output/plot18en17.png'
plot 'middle/plot18en.csv' u 1:114 w lp ti col,'' u 1:115 w lp ti col,'' u 1:116 w lp ti col,'' u 1:117 w lp ti col,'' u 1:118 w lp ti col,'' u 1:119 w lp ti col,'' u 1:120 w lp ti col
set yrange [0:70]
set ytics 0,14,56
set output 'output/plot18en18.png'
plot 'middle/plot18en.csv' u 1:121 w lp ti col,'' u 1:122 w lp ti col,'' u 1:123 w lp ti col,'' u 1:124 w lp ti col,'' u 1:125 w lp ti col,'' u 1:126 w lp ti col,'' u 1:127 w lp ti col
set yrange [0:1100]
set ytics 0,220,880
set output 'output/plot18en19.png'
plot 'middle/plot18en.csv' u 1:128 w lp ti col,'' u 1:129 w lp ti col,'' u 1:130 w lp ti col,'' u 1:131 w lp ti col,'' u 1:132 w lp ti col,'' u 1:133 w lp ti col,'' u 1:134 w lp ti col
set yrange [0:30000]
set ytics 0,6000,24000
set output 'output/plot18en20.png'
plot 'middle/plot18en.csv' u 1:135 w lp ti col,'' u 1:136 w lp ti col,'' u 1:137 w lp ti col,'' u 1:138 w lp ti col,'' u 1:139 w lp ti col,'' u 1:140 w lp ti col,'' u 1:141 w lp ti col
set yrange [0:2000]
set ytics 0,400,1600
set output 'output/plot18en21.png'
plot 'middle/plot18en.csv' u 1:142 w lp ti col,'' u 1:143 w lp ti col,'' u 1:144 w lp ti col,'' u 1:145 w lp ti col,'' u 1:146 w lp ti col,'' u 1:147 w lp ti col,'' u 1:148 w lp ti col
set yrange [0:20]
set ytics 0,4,16
set output 'output/plot18en22.png'
plot 'middle/plot18en.csv' u 1:149 w lp ti col,'' u 1:150 w lp ti col,'' u 1:151 w lp ti col,'' u 1:152 w lp ti col,'' u 1:153 w lp ti col,'' u 1:154 w lp ti col,'' u 1:155 w lp ti col
set yrange [0:2000]
set ytics 0,400,1600
set output 'output/plot18en23.png'
plot 'middle/plot18en.csv' u 1:156 w lp ti col,'' u 1:157 w lp ti col,'' u 1:158 w lp ti col,'' u 1:159 w lp ti col,'' u 1:160 w lp ti col,'' u 1:161 w lp ti col,'' u 1:162 w lp ti col
set yrange [0:200]
set ytics 0,40,160
set output 'output/plot18en24.png'
plot 'middle/plot18en.csv' u 1:163 w lp ti col,'' u 1:164 w lp ti col,'' u 1:165 w lp ti col,'' u 1:166 w lp ti col,'' u 1:167 w lp ti col,'' u 1:168 w lp ti col,'' u 1:169 w lp ti col
set yrange [0:200]
set ytics 0,40,160
set output 'output/plot18en25.png'
plot 'middle/plot18en.csv' u 1:170 w lp ti col,'' u 1:171 w lp ti col,'' u 1:172 w lp ti col,'' u 1:173 w lp ti col,'' u 1:174 w lp ti col,'' u 1:175 w lp ti col,'' u 1:176 w lp ti col
set yrange [0:300]
set ytics 0,60,240
set output 'output/plot18en26.png'
plot 'middle/plot18en.csv' u 1:177 w lp ti col,'' u 1:178 w lp ti col,'' u 1:179 w lp ti col,'' u 1:180 w lp ti col,'' u 1:181 w lp ti col,'' u 1:182 w lp ti col,'' u 1:183 w lp ti col
set yrange [0:6000]
set ytics 0,1200,4800
set output 'output/plot18en27.png'
plot 'middle/plot18en.csv' u 1:184 w lp ti col,'' u 1:185 w lp ti col,'' u 1:186 w lp ti col,'' u 1:187 w lp ti col,'' u 1:188 w lp ti col,'' u 1:189 w lp ti col,'' u 1:190 w lp ti col
set yrange [0:2000]
set ytics 0,400,1600
set output 'output/plot18en28.png'
plot 'middle/plot18en.csv' u 1:191 w lp ti col,'' u 1:192 w lp ti col,'' u 1:193 w lp ti col,'' u 1:194 w lp ti col,'' u 1:195 w lp ti col,'' u 1:196 w lp ti col,'' u 1:197 w lp ti col
set yrange [0:20000]
set ytics 0,4000,16000
set output 'output/plot18en29.png'
plot 'middle/plot18en.csv' u 1:198 w lp ti col,'' u 1:199 w lp ti col,'' u 1:200 w lp ti col,'' u 1:201 w lp ti col,'' u 1:202 w lp ti col,'' u 1:203 w lp ti col,'' u 1:204 w lp ti col
set yrange [0:6000]
set ytics 0,1200,4800
set output 'output/plot18en30.png'
plot 'middle/plot18en.csv' u 1:205 w lp ti col,'' u 1:206 w lp ti col,'' u 1:207 w lp ti col,'' u 1:208 w lp ti col,'' u 1:209 w lp ti col,'' u 1:210 w lp ti col,'' u 1:211 w lp ti col
set yrange [0:10000]
set ytics 0,2000,8000
set output 'output/plot18en31.png'
plot 'middle/plot18en.csv' u 1:212 w lp ti col,'' u 1:213 w lp ti col,'' u 1:214 w lp ti col,'' u 1:215 w lp ti col,'' u 1:216 w lp ti col,'' u 1:217 w lp ti col,'' u 1:218 w lp ti col
set yrange [0:5000]
set ytics 0,1000,4000
set output 'output/plot18en32.png'
plot 'middle/plot18en.csv' u 1:219 w lp ti col,'' u 1:220 w lp ti col,'' u 1:221 w lp ti col,'' u 1:222 w lp ti col,'' u 1:223 w lp ti col,'' u 1:224 w lp ti col,'' u 1:225 w lp ti col
set yrange [0:3000]
set ytics 0,600,2400
set output 'output/plot18en33.png'
plot 'middle/plot18en.csv' u 1:226 w lp ti col,'' u 1:227 w lp ti col,'' u 1:228 w lp ti col,'' u 1:229 w lp ti col,'' u 1:230 w lp ti col,'' u 1:231 w lp ti col,'' u 1:232 w lp ti col
set yrange [0:900]
set ytics 0,180,720
set output 'output/plot18en34.png'
plot 'middle/plot18en.csv' u 1:233 w lp ti col,'' u 1:234 w lp ti col,'' u 1:235 w lp ti col,'' u 1:236 w lp ti col,'' u 1:237 w lp ti col,'' u 1:238 w lp ti col,'' u 1:239 w lp ti col
set yrange [0:30000]
set ytics 0,6000,24000
set output 'output/plot18en35.png'
plot 'middle/plot18en.csv' u 1:240 w lp ti col,'' u 1:241 w lp ti col,'' u 1:242 w lp ti col,'' u 1:243 w lp ti col,'' u 1:244 w lp ti col,'' u 1:245 w lp ti col,'' u 1:246 w lp ti col
set yrange [0:3000]
set ytics 0,600,2400
set output 'output/plot18en36.png'
plot 'middle/plot18en.csv' u 1:247 w lp ti col,'' u 1:248 w lp ti col,'' u 1:249 w lp ti col,'' u 1:250 w lp ti col,'' u 1:251 w lp ti col,'' u 1:252 w lp ti col,'' u 1:253 w lp ti col
set yrange [0:3000]
set ytics 0,600,2400
set output 'output/plot18en37.png'
plot 'middle/plot18en.csv' u 1:254 w lp ti col,'' u 1:255 w lp ti col,'' u 1:256 w lp ti col,'' u 1:257 w lp ti col,'' u 1:258 w lp ti col,'' u 1:259 w lp ti col,'' u 1:260 w lp ti col
set yrange [0:30000]
set ytics 0,6000,24000
set output 'output/plot18en38.png'
plot 'middle/plot18en.csv' u 1:261 w lp ti col,'' u 1:262 w lp ti col,'' u 1:263 w lp ti col,'' u 1:264 w lp ti col,'' u 1:265 w lp ti col,'' u 1:266 w lp ti col,'' u 1:267 w lp ti col

