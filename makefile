
# common targets

first:
	@echo "Nothing to do, please, specify a target ..."

all: clean continue

clean:
	@echo make continue
	rm -f middle/* output/* index.*

continue:
	@echo make continue
	time -p php php/program.php

# git targets

status:
	@echo make status
	git status | less -F

add:
	@echo make add
	git add .

commit:
	@echo make commit
	git commit -m "`php scripts/gitcommit.php`" -e

push:
	@echo make push
	git push

log:
	@echo make log
	git log

# individual targets

index:
	@echo make index
	rm -f index.*
	time -p php php/program.php

momo:
	@echo make momo
	rm -f middle/datanew* output/plot0[1-5,8]* output/plot1[2,4]* output/plot2[2,4,6,7,8]*
	time -p php php/program.php

momoold:
	@echo make momoold
	rm -f middle/dataold* output/plot15* output/plot2[7,8]*
	time -p php php/program.php

momo2wave:
	@echo make momo2wave
	rm -f output/plot15??.gif
	time -p php php/program.php

momo2data:
	@echo make momo2data
	rm -f middle/data.* middle/plot15* output/plot15* output/plot24*
	time -p php php/program.php

euromomo:
	@echo make euromomo
	rm -f middle/component.* middle/plot09* output/plot09*
	time -p php php/program.php

sweden:
	@echo make sweden
	rm -f middle/preliminar_statistik.csv output/plot10*
	time -p php php/program.php

norway:
	@echo make norway
	rm -f output/plot11*
	time -p php php/program.php

portugal:
	@echo make portugal
	rm -f middle/dados_sico.csv output/plot13*
	time -p php php/program.php

france:
	@echo make france
	rm -f middle/dc_20xx_det.csv output/plot16*
	time -p php php/program.php

germany:
	@echo make germany
	rm -f middle/sterbefallzahlen.csv output/plot17*
	time -p php php/program.php

eurostat:
	@echo make eurostat
	rm -f middle/demo_r_mwk_ts.csv output/plot18*
	time -p php php/program.php

spain:
	@echo make spain
	rm -f middle/35177* output/plot19* output/plot23*
	time -p php php/program.php

indef:
	@echo make indef
	rm -f middle/defunciones.csv output/plot2[0,3,8]*
	time -p php php/program.php
