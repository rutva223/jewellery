#!/bin/bash

# Laravel Jewellery Project Setup Script for Ubuntu
# This script will install all required dependencies and set up the project

set -e  # Exit on error

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}Laravel Jewellery Project Setup Script${NC}"
echo -e "${GREEN}========================================${NC}"

# Check if running on Ubuntu
if ! command -v apt &> /dev/null; then
    echo -e "${RED}This script is designed for Ubuntu/Debian systems.${NC}"
    exit 1
fi

# Update system packages
echo -e "\n${YELLOW}Updating system packages...${NC}"
sudo apt update

# Install software-properties-common for add-apt-repository
echo -e "\n${YELLOW}Installing prerequisites...${NC}"
sudo apt install -y software-properties-common curl wget git unzip

# Install PHP 8.1 and required extensions
echo -e "\n${YELLOW}Installing PHP 8.1 and required extensions...${NC}"
sudo add-apt-repository -y ppa:ondrej/php
sudo apt update
sudo apt install -y php8.1 php8.1-cli php8.1-common php8.1-fpm \
    php8.1-mysql php8.1-xml php8.1-xmlrpc php8.1-curl php8.1-gd \
    php8.1-imagick php8.1-intl php8.1-mbstring php8.1-zip \
    php8.1-bcmath php8.1-imap php8.1-soap php8.1-opcache \
    php8.1-readline php8.1-sqlite3 php8.1-redis

# Verify PHP installation
echo -e "\n${YELLOW}PHP Version:${NC}"
php -v

# Install Composer
echo -e "\n${YELLOW}Installing Composer...${NC}"
if ! command -v composer &> /dev/null; then
    curl -sS https://getcomposer.org/installer -o composer-setup.php
    sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
    rm composer-setup.php
fi
echo -e "${GREEN}Composer version:${NC}"
composer --version

# Install MySQL Server
echo -e "\n${YELLOW}Installing MySQL Server...${NC}"
sudo apt install -y mysql-server

# Start and enable MySQL
sudo systemctl start mysql
sudo systemctl enable mysql

# Install Node.js 18.x LTS and npm
echo -e "\n${YELLOW}Installing Node.js 18.x LTS and npm...${NC}"
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install -y nodejs

echo -e "${GREEN}Node.js version:${NC}"
node --version
echo -e "${GREEN}npm version:${NC}"
npm --version

# Install Apache web server
echo -e "\n${YELLOW}Installing Apache web server...${NC}"
sudo apt install -y apache2 libapache2-mod-php8.1

# Enable Apache modules
sudo a2enmod rewrite
sudo a2enmod php8.1

# Install Redis (optional but recommended)
echo -e "\n${YELLOW}Installing Redis server (optional)...${NC}"
sudo apt install -y redis-server
sudo systemctl start redis-server
sudo systemctl enable redis-server

# Create MySQL database and user
echo -e "\n${YELLOW}Setting up MySQL database...${NC}"
echo -e "${GREEN}Enter MySQL root password (press Enter if none):${NC}"
read -s MYSQL_ROOT_PASSWORD

# Generate random password for Laravel database user
DB_PASSWORD=$(openssl rand -base64 12)
DB_NAME="jewellery_db"
DB_USER="jewellery_user"

# Create database and user
if [ -z "$MYSQL_ROOT_PASSWORD" ]; then
    sudo mysql << EOF
CREATE DATABASE IF NOT EXISTS $DB_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASSWORD';
GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'localhost';
FLUSH PRIVILEGES;
EOF
else
    mysql -u root -p$MYSQL_ROOT_PASSWORD << EOF
CREATE DATABASE IF NOT EXISTS $DB_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASSWORD';
GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'localhost';
FLUSH PRIVILEGES;
EOF
fi

echo -e "${GREEN}Database created successfully!${NC}"
echo -e "${YELLOW}Database Name: $DB_NAME${NC}"
echo -e "${YELLOW}Database User: $DB_USER${NC}"
echo -e "${YELLOW}Database Password: $DB_PASSWORD${NC}"

# Get current directory (project root)
PROJECT_DIR=$(pwd)

# Install Composer dependencies
echo -e "\n${YELLOW}Installing Composer dependencies...${NC}"
composer install --no-interaction

# Copy environment file
echo -e "\n${YELLOW}Setting up environment configuration...${NC}"
if [ ! -f .env ]; then
    cp .env.example .env
    echo -e "${GREEN}.env file created from .env.example${NC}"
else
    echo -e "${YELLOW}.env file already exists${NC}"
fi

# Update .env file with database credentials
sed -i "s/DB_DATABASE=.*/DB_DATABASE=$DB_NAME/" .env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=$DB_USER/" .env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$DB_PASSWORD/" .env

# Generate application key
echo -e "\n${YELLOW}Generating application key...${NC}"
php artisan key:generate

# Run database migrations
echo -e "\n${YELLOW}Running database migrations...${NC}"
php artisan migrate --force

# Install npm dependencies
echo -e "\n${YELLOW}Installing npm dependencies...${NC}"
npm install

# Build frontend assets
echo -e "\n${YELLOW}Building frontend assets...${NC}"
npm run build

# Set proper permissions
echo -e "\n${YELLOW}Setting proper permissions...${NC}"
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

# Configure Apache virtual host
echo -e "\n${YELLOW}Configuring Apache virtual host...${NC}"
VHOST_CONFIG="/etc/apache2/sites-available/jewellery-laravel.conf"
sudo tee $VHOST_CONFIG > /dev/null <<EOF
<VirtualHost *:80>
    ServerName jewellery.local
    ServerAlias www.jewellery.local
    DocumentRoot $PROJECT_DIR/public

    <Directory $PROJECT_DIR/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/jewellery-error.log
    CustomLog \${APACHE_LOG_DIR}/jewellery-access.log combined
</VirtualHost>
EOF

# Enable the site
sudo a2ensite jewellery-laravel.conf
sudo a2dissite 000-default.conf

# Add entry to hosts file
echo -e "\n${YELLOW}Adding entry to /etc/hosts...${NC}"
if ! grep -q "jewellery.local" /etc/hosts; then
    echo "127.0.0.1    jewellery.local www.jewellery.local" | sudo tee -a /etc/hosts
fi

# Restart Apache
echo -e "\n${YELLOW}Restarting Apache...${NC}"
sudo systemctl restart apache2

# Clear Laravel caches
echo -e "\n${YELLOW}Clearing Laravel caches...${NC}"
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Create storage link
echo -e "\n${YELLOW}Creating storage link...${NC}"
php artisan storage:link

# Display summary
echo -e "\n${GREEN}========================================${NC}"
echo -e "${GREEN}Setup completed successfully!${NC}"
echo -e "${GREEN}========================================${NC}"
echo -e "\n${YELLOW}Project Information:${NC}"
echo -e "Project Directory: $PROJECT_DIR"
echo -e "Database Name: $DB_NAME"
echo -e "Database User: $DB_USER"
echo -e "Database Password: $DB_PASSWORD"
echo -e "\n${YELLOW}Access your application:${NC}"
echo -e "URL: http://jewellery.local"
echo -e "\n${YELLOW}To run development server:${NC}"
echo -e "php artisan serve"
echo -e "npm run dev (in another terminal for hot reload)"
echo -e "\n${YELLOW}Important notes:${NC}"
echo -e "1. Save the database password shown above"
echo -e "2. You can access the site at http://jewellery.local"
echo -e "3. Or run 'php artisan serve' to use http://localhost:8000"
echo -e "\n${GREEN}Happy coding!${NC}"