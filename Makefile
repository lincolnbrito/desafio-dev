dc=docker-compose
COLOR_GREEN=\033[0;32m
COLOR_RED=\033[0;31m
NO_COLOR=\033[0m
ICON_CLOCK=\342\217\261
ICON_CHECK=\342\234\224
ICON_EARTH=\360\237\214\215
ICON_TEST=\360\237\244\226

start:
	@printf "\n${ICON_CLOCK}  Starting application. Wait...\n\n"
	@printf "${NC}"
	$(dc) up app api mysql
	@printf "\n${COLOR_GREEN}${ICON_EARTH} Application STARTED!${NO_COLOR}\n"
	@printf "\n- App: http://localhost:8080"
	@printf "\n- Api: http://localhost\n\n"

setup:
	./setup.sh

stop:
	$(dc) stop

logs:
	$(dc) logs

fresh:
	@printf "${COLOR_RED}CAUTION! This action will delete api/vendor, app/node_modules and drop the database. Do you want to continue? [y|N] ${NO_COLOR}"
	@read ans; \
	if [ $${ans:-N} = y ]; \
	then \
		$(dc) run --rm api php artisan db:wipe; \
		rm -Rf api/vendor; \
		rm -Rf app/node_modules; \
	fi

down:
	$(dc) down --remove-orphans

test: |	test-api test-app

test-api:
	@printf "\n---------------------------------\n"
	@printf "${ICON_TEST} RUNNING API TESTS"
	@printf "\n---------------------------------\n"
	$(dc) run --rm --no-deps api php artisan test

test-app:
	@printf "\n---------------------------------\n"
	@printf "${ICON_TEST} RUNNING APP TESTS"
	@printf "\n---------------------------------\n"
	$(dc) run --rm app yarn test:unit