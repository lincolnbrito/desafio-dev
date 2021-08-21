COLOR_RED='\033[0;31m'
COLOR_GREEN='\033[0;32m'
NO_COLOR='\033[0m'
ICON_CLOCK='\342\217\261 '
ICON_STAR='\360\237\214\237'
ICON_CHECK='\342\234\224'
ICON_TIMES='\342\234\226'

printf "\n___________________________________________________\n"
printf "ByCoders - DEV CHALLENGE\n"
printf "Lincoln S. Brito <lincoln.sbrito@gmail.com>"
printf "\n___________________________________________________\n\n"
printf "PREPARING APPLICATION...\n"
printf "${NO_COLOR}"

printf "\n--------------------------------------------------------------------------------------------\n"
printf "${ICON_CLOCK} Copying files"
printf "\n--------------------------------------------------------------------------------------------\n"
printf "${ICON_STAR} Copying Docker .env file..."
if [ ! -f .env ]; then
    cp .env.example .env
    printf "${COLOR_GREEN}${ICON_CHECK}"
else
    printf "${COLOR_RED}${ICON_TIMES} File already exists!"
fi

printf "${NO_COLOR}\n"

printf "${ICON_STAR} Copying Laravel .env file... "
if [ ! -f api/.env ]; then
  cp api/.env.example api/.env
  printf "${COLOR_GREEN}${ICON_CHECK}"
else
  printf "${COLOR_RED}${ICON_TIMES} File already exists!"
fi

printf "${NO_COLOR}\n"

printf "\n--------------------------------------------------------------------------------------------\n"
printf "${ICON_CLOCK} API"
printf "\n--------------------------------------------------------------------------------------------\n"
printf "${ICON_STAR} Installing dependencies...\n"
docker-compose run --rm --no-deps api composer install

printf "\n${ICON_STAR} Generating laravel app key...\n"
docker-compose run --rm --no-deps api php artisan key:generate

printf "\n${ICON_STAR} Migrating database...\n"
docker-compose run --rm api php artisan migrate

printf "\n--------------------------------------------------------------------------------------------\n"
printf "${ICON_CLOCK} APP"
printf "\n--------------------------------------------------------------------------------------------\n"
printf "${ICON_STAR} Installing dependencies...\n"
docker-compose run --rm --no-deps app yarn

printf "\n\n${COLOR_GREEN}${ICON_CHECK} The application has been configured successfully!${NO_COLOR} \n"
printf "Run 'make start' to start the application!\n"
printf "${NO_COLOR}\n"