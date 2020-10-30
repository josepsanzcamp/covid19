
all:
	rm -f middle/* output/* index.*
	time -p php program.php

clean:
	rm -f middle/* output/* index.*

momo:
	rm -f middle/datanew* output/plot0[1-5,8]* output/plot1[2,4]* output/plot15*.gif
	time -p php program.php

euromomo:
	rm -f output/plot09*.gif
	time -p php program.php

euromomo.all:
	rm -f middle/euromomo* output/plot09* index.*.html
	time -p php program.php

sweden:
	rm -f output/plot10*
	time -p php program.php

norway:
	rm -f output/plot11*
	time -p php program.php

portugal:
	rm -f output/plot13*
	time -p php program.php
