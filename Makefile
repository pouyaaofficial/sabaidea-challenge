init:
	@make up
	./assistant composer install

up:
	@./assistant up -d

down:
	@./assistant down

stylefix:
	@./assistant composer stylefix