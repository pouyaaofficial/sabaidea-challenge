init:
	@cp .env.example .env
	@chmod +x ./assistant
	@./assistant up -d --build
	@./assistant composer install --ignore-platform-reqs

up:
	@./assistant up -d

down:
	@./assistant down

stylefix:
	@./assistant composer stylefix