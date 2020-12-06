
first:
	@echo "Nothing to do, please, specify a target ..."

all:
	rm -f middle/* output/* index.*
	time -p php php/program.php

clean:
	rm -f middle/* output/* index.*

continue:
	time -p php php/program.php

index:
	rm -f index.*
	time -p php php/program.php

momo:
	rm -f middle/datanew* output/plot0[1-5,8]* output/plot1[2,4]*
	time -p php php/program.php

momo2wave:
	rm -f output/plot15*.gif
	time -p php php/program.php

momo.old:
	rm -f middle/data.* output/plot15*.gif
	time -p php php/program.php

euromomo:
	rm -f output/plot09*.gif
	time -p php php/program.php

euromomo.old:
	rm -f middle/component* output/plot09*
	time -p php php/program.php

sweden:
	rm -f middle/preliminar_statistik.csv output/plot10*
	time -p php php/program.php

norway:
	rm -f output/plot11*
	time -p php php/program.php

portugal:
	rm -f middle/dados_sico.csv output/plot13*
	time -p php php/program.php

france:
	rm -f middle/dc_20xx_det.csv output/plot16*
	time -p php php/program.php

germany:
	rm -f middle/sterbefallzahlen.csv output/plot17*
	time -p php php/program.php

eurostat:
	rm -f middle/demo_r_mwk_ts.csv output/plot18*
	time -p php php/program.php

spain:
	rm -f middle/35177* output/plot19*
	time -p php php/program.php

