FROM php:8.2-cli

# نصب افزونه curl (برای ارتباط با Telegram API)
RUN apt-get update && apt-get install -y curl

WORKDIR /app
COPY . .

# پورت Railway باید 3000 باشه
CMD ["php", "-S", "0.0.0.0:3000", "send-location.php"]
