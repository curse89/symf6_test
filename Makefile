symf_cli:
	@echo 'deb [trusted=yes] https://repo.symfony.com/apt/ /' | tee /etc/apt/sources.list.d/symfony-cli.list
	@apt update
	@apt install symfony-cli

symf_create:
	@symfony new temp --webapp
	@mv temp/* .
	@rm -R temp

rem_temp:
	@rm -R temp

symf_create_composer:
	@composer create-project symfony/skeleton temp
	@mv temp/* .
	@rm -R temp
	@composer require webapp

vue_install:
	@yarn global add @vue/cli
	@vue upgrade --next
